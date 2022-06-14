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
            $profit->is_valid = $request->input('status');
            $profit->save();

            $user = User::find($profit->user_id);
            $receiverEmail = $user->email;
            $emailBody = new \stdClass();
            $emailBody->sender = 'Asparecargas';
            $emailBody->receiver = $user->name;

            if($profit->is_valid == 1){
                $user->profit = $user->profit - $profit->amount;

                $emailSubject = 'Retiro de ganacias aprobado';
                $emailBody->body = 'Su solicitud de retiro de ganancias por valor de $'.$profit->amount.' fue aprobada.';
            }else{
                $user->profit = $user->profit + $profit->amount;
                
                $emailSubject = 'Retiro de ganacias revertido';
                $emailBody->body = 'La solicitud de retiro de ganancias #'.$profit->id.' por valor de $'.$profit->amount.' fue invalidada a consideración de un administrador.';
            }
            Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));
            $user->save();
            
            return back();
        }
    }
}
