<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateBalanceController extends Controller
{
    public function isValid(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $balance = Balance::find($request->input('id'));
            $balance->is_valid = $request->input('status');
            $balance->save();

            $user = User::find($balance->user_id);
            if($balance->is_valid == 1){
                if($balance->type == 'Deposit' || $balance->type == 'Recharge'){
                    $user->balance = $user->balance+$balance->amount;
                }elseif($balance->type == 'Withdrawal'){
                    $user->balance = $user->balance-$balance->amount;
                }
            }else{
                if($balance->type == 'Deposit' || $balance->type == 'Recharge'){
                    $user->balance = $user->balance-$balance->amount;
                }elseif($balance->type == 'Withdrawal'){
                    $user->balance = $user->balance+$balance->amount;
                }
            }
            $user->save();
            
            return back();
        }
    }
}
