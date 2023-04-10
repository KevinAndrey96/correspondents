<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Models\User;
use App\Models\Summary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;
use Carbon\Carbon;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Mail;

class AddBalanceAdminController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $user = User::find($request->input('userID'));
            if($request->input('type') == 'Withdrawal' and $user->role == 'Shopkeeper'){
                $fields = [
                    'amount'=>'required|numeric|min:0|max:'.$user->balance,
                ];
            }else{
                $fields = [
                    'amount'=>'required|numeric|min:0',
                ];
            }
            $message = [
                'required'=>':attribute es requerido',
                'amount.max'=>'El monto no puede ser mayor a :max',
            ];
            $this->validate($request, $fields, $message);

            $date = Carbon::now();
            $balance = new Balance();
            $balance->user_id = $request->input('userID');
            $balance->amount = $request->input('amount');
            date_default_timezone_set('America/Bogota');
            $balance->date = $date;
            $balance->type = $request->input('type');
            $balance->comment = $request->input('comment');
            $balance->administrator_id = Auth::user()->id;
            $balance->is_valid = 1;
            $balance->save();

            $summary = new Summary();
            $summary->user_id = $request->input('userID');
            $summary->amount = $balance->amount;
            $summary->previous_balance = $user->balance;

            if ($request->input('type') == 'Deposit') {
                $summary->movement_type = 'Recarga de Saldo ';
                $summary->next_balance = $user->balance + $balance->amount;
            }

            if ($request->input('type') == 'Withdrawal') {
                $summary->movement_type = 'Retiro por Administrador ';
                $summary->next_balance = $user->balance - $balance->amount;
            }

            $summary->save();

            if ($request->hasFile('image')) {
                $pathName = Sprintf('balances/%s.png', $balance->id);
                Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
                $client = new Client();
                $url = "https://corresponsales.asparecargas.net/upload.php";
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace('\\', '/', Storage::disk('public')->path('balances/' .$balance->id . '.png')),'r'),
                        ],
                        [
                            'name' => 'path',
                            'contents' => 'balances'
                        ]
                    ]
                ]);
                $balance->boucher = '/storage/balances/' . $balance->id . '.png';
                $balance->save();
                unlink(str_replace('\\', '/', storage_path('app/public/balances/'.$balance->id.'.png')));
            }

            $receiverEmail = $user->email;
            $emailBody = new \stdClass();
            $emailBody->sender = 'Asparecargas';
            $emailBody->receiver = $user->name;
            $emailSubject = 'Solicitud de saldo Personal';
            if($balance->type == 'Deposit'){
                $user->balance = $user->balance+$balance->amount;

                $emailBody->body = 'Su solicitud personal de recarga de saldo por valor de $'.$balance->amount.' fue aprobada.';
            }elseif($balance->type == 'Withdrawal'){
                $user->balance = $user->balance-$balance->amount;

                $emailBody->body = 'Su solicitud personal de retiro de saldo por valor de $'.$balance->amount.' fue aprobada.';
            }
            $user->save();
            Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));

            return back();
        }
    }
}
