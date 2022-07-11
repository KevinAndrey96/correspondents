<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class adminWithdrawProfitController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $profit = Profit::find($request->input('profitID'));
            $emailBody = new \stdClass();
            $emailBody->sender = 'Asparecargas';
            $user = User::find($profit->user_id);
            $receiverEmail = $user->email;
            $status = $request->input('status');
            $comment = $request->input('comment');
            $emailBody->receiver = $user->name;
            if ($status == 'accepted') {
                $profit->is_valid = 1;
                $user->profit -= $profit->amount;
                $emailSubject = 'Retiro de ganacias aprobado';
                $emailBody->body = 'Su solicitud de retiro de ganancias por valor de $'.$profit->amount.' fue aprobada.';
            }
            if ($status == 'rejected') {
                $profit->is_valid = 0;
                $emailSubject = 'Retiro de ganacias rechazado';
                $emailBody->body = 'La solicitud de retiro de ganancias #'.$profit->id.' por valor de $'.$profit->amount.' fue rechazada a consideración de un administrador.';
            }
            if (isset($comment)) {
                $profit->comment = $comment;
            }
            $profit->save();
            $user->save();
            Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));
            if ($request->hasFile('image')) {
                $pathName = Sprintf('profits/%s.png', $profit->id);
                Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
                //dd(Storage::path('profits\\' .$profit->id . '.png'));
                //dd(Storage::disk('public')->path('profits/' .$profit->id . '.png'));
                $client = new Client();
                $url = "https://corresponsales.asparecargas.net/upload.php";
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace('\\', '/', Storage::disk('public')->path('profits/' .$profit->id . '.png')),'r'),
                        ],
                        [
                            'name' => 'path',
                            'contents' => 'profits'
                        ]
                    ]
                ]);
                $profit->boucher = '/storage/profits/' . $profit->id . '.png';
                $profit->save();
                unlink(str_replace('\\', '/', storage_path('app/public/profits/'.$profit->id.'.png')));
            }

            return back();
        }
    }
}
