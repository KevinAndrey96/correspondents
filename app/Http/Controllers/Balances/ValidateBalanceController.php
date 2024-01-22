<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Models\User;
use App\Models\Summary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Mail;

class ValidateBalanceController extends Controller
{
    public function isValid(Request $request)
    {
        if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos') {
            date_default_timezone_set('America/Bogota');
            $balance = Balance::find($request->input('id'));

            if(is_null($balance->is_valid)){
                $balance->is_valid = $request->input('status');
                $balance->comment = $request->input('comment');
                $balance->administrator_id = Auth::user()->id;
                $balance->save();
                $balance->admin_date = $balance->updated_at;
                $balance->save();

                $user = User::find($balance->user_id);
                $receiverEmail = $user->email;
                $emailBody = new \stdClass();
                $emailBody->sender = 'Asparecargas';
                $emailBody->receiver = $user->name;

                if($balance->is_valid == 1){
                    $summary = new Summary();
                    $summary->movement_id = $balance->id;
                    $summary->user_id = $balance->user_id;
                    $summary->amount = $balance->amount;
                    $summary->previous_balance = $user->balance;

                    if (isset($balance->card->bank)) {
                        $summary->bank = $balance->card->bank;
                    }

                    if ($balance->type == 'Deposit' || $balance->type == 'Recharge') {
                        $user->balance = $user->balance+$balance->amount;
                        $emailBody->body = 'Su solicitud de recarga de saldo por valor de $'.$balance->amount.' fue aprobada.';
                        $summary->movement_type = 'Recarga de Saldo';
                    } elseif ($balance->type == 'Withdrawal'){
                        $user->balance = $user->balance-$balance->amount;
                        $emailBody->body = 'Se retiro saldo por valor de $'.$balance->amount.' a consideración de un administrador.';
                        $summary->movement_type = 'Retiro por Administrador';
                    }

                    $summary->next_balance = $user->balance;
                    $emailSubject = 'Solicitud de saldo aprobada';
                    $summary->save();
                }else{
                    $emailSubject = 'Solicitud de saldo rechazada';
                    $emailBody->body = 'La solicitud de recarga de saldo #'.$balance->id.' por valor de $'.$balance->amount.' fue rechazada a consideración de un administrador.';
                }
                $user->save();
                Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));

                return back();
            }
        }
    }

}
