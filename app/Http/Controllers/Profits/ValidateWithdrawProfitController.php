<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Mail;

class ValidateWithdrawProfitController extends Controller
{
    public function isValid(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $profit = Profit::find($request->input('id'));
            if(is_null($profit->is_valid)){
                $profit->is_valid = $request->input('status');
                $profit->comment = $request->input('comment');
                $profit->save();

                $user = User::find($profit->user_id);
                $receiverEmail = $user->email;
                $emailBody = new \stdClass();
                $emailBody->sender = 'Asparecargas';
                $emailBody->receiver = $user->name;
                if($user->profit >= $profit->amount){
                    if($profit->is_valid == 1){
                        $user->profit = $user->profit - $profit->amount;

                        $emailSubject = 'Retiro de ganacias aprobado';
                        $emailBody->body = 'Su solicitud de retiro de ganancias por valor de $'.$profit->amount.' fue aprobada.';
                    }else{
                        $emailSubject = 'Retiro de ganacias rechazado';
                        $emailBody->body = 'La solicitud de retiro de ganancias #'.$profit->id.' por valor de $'.$profit->amount.' fue rechazada a consideración de un administrador.';
                    }
                }else{
                    $profit->is_valid = 0;
                    $profit->save();
                    $emailSubject = 'Retiro de ganacias rechazado, sin ganancias suficientes';
                    $emailBody->body = 'La solicitud de retiro de ganancias #'.$profit->id.' por valor de $'.$profit->amount.' fue rechazada a consideración de un administrador, no cuenta con ganancias acumuladas suficientes para retirar.';
                }
                Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));
                $user->save();

                return back();
            }
        }
    }
}
