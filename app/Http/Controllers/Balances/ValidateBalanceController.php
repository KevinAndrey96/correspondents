<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Mail;

class ValidateBalanceController extends Controller
{
    public function isValid(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $balance = Balance::find($request->input('id'));
            //if(is_null($balance->is_valid)){
                $balance->is_valid = $request->input('status');
                $balance->comment = $request->input('comment');
                $balance->save();

                $user = User::find($balance->user_id);
                $receiverEmail = $user->email;
                $emailBody = new \stdClass();
                $emailBody->sender = 'Asparecargas';
                $emailBody->receiver = $user->name;

                if($balance->is_valid == 1){
                    if($balance->type == 'Deposit'){
                        $user->balance = $user->balance+$balance->amount;
                    }elseif($balance->type == 'Withdrawal'){
                        $user->balance = $user->balance-$balance->amount;
                    }

                    $emailSubject = 'Solicitud de saldo aprobada';
                    $emailBody->body = 'Su solicitud de recarga de saldo por valor de $'.$balance->amount.' fue aprobada.';
                }else{
                    $emailSubject = 'Solicitud de saldo rechazada';
                    $emailBody->body = 'La solicitud de recarga de saldo #'.$balance->id.' por valor de $'.$balance->amount.' fue rechazada a consideración de un administrador.';
                }
                Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));
                $user->save();
                
                return back();
            //}
        }
    }
}
