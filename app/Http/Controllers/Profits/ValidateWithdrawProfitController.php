<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateWithdrawProfitController extends Controller
{
    public function isValid(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $profit = Profit::find($request->input('id'));
            $profit->is_valid = $request->input('status');
            $profit->save();

            $user = User::find($profit->user_id);
            if($profit->is_valid == 1){
                $user = User::find($profit->user_id);
                $user->profit = $user->profit - $profit->amount;
            }else{
                $user = User::find($profit->user_id);
                $user->profit = $user->profit + $profit->amount;
            }
            $user->save();
            
            return back();
        }
    }
}
