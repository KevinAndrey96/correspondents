<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateBalanceController extends Controller
{
    public function isValid($balanceID)
    {
        if (Auth::user()->role == 'Administrator') {
            $balance = Balance::find($balanceID);
            if($balance->is_valid == 0){
                $balance->is_valid = 1;
            }elseif($balance->is_valid == 1){
                $balance->is_valid = 0;
            }
            $balance->save();

            /*$user = User::find($balance->user_id);
            $user->balance = $user->balance+$balance->amount;
            dd($user->balance);*/
            
            return redirect('balance');
        }
    }
}
