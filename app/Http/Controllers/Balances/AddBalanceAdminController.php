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
                    'amount'=>'required',
                ];
            }else{
                $fields = [
                    'amount'=>'required',
                ];
            }
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);

            date_default_timezone_set('America/Bogota');

            $amount = floatval(amountFormat($request->amount));

            if ($amount <= 0) {
                return redirect('/users?role='.$user->role)->with('negativeBalance','El saldo a asignar no permitido');
            }

            if (getenv('COUNTRY_NAME') == 'ECUADOR' && $amount > 10000) {
                return redirect('/users?role='.$user->role)->with('balanceNotAllowed','El máximo saldo que puedo asignar es de 10000');
            }

            if ($request->type == 'Withdrawal' && $amount > $user->balance) {
                return redirect('/users?role='.$user->role);
            }

            $date = Carbon::now();
            $balance = new Balance();
            $balance->user_id = $request->input('userID');
            $balance->amount =  $amount;
            $balance->date = '';
            $balance->type = $request->input('type');
            $balance->comment = $request->input('comment');
            $balance->administrator_id = Auth::user()->id;
            $balance->is_valid = 1;
            $balance->indirect = 1;
            $balance->save();
            $balance->admin_date = $balance->created_at;
            $balance->date = $balance->created_at;
            $balance->save();

            $summary = new Summary();
            $summary->movement_id = $balance->id;
            $summary->user_id = $request->input('userID');
            $summary->amount = $balance->amount;
            $summary->previous_balance = $user->balance;

            if (isset($balance->card->bank)) {
                $summary->bank = $balance->card->bank;
            }

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
