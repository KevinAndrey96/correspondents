<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StoreBalanceController extends Controller
{
    public function store(Request $request)
    {
        $fields = [
            'userID'=>'required',
            'balanceAmount'=>'required|numeric|min:1.0',
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $balanceDate = Carbon::now();
        $balance = new Balance();
        $balance->user_id = $request->input('userID');
        $balance->balance_amount = $request->input('balanceAmount');
        $balance->balance_date = $balanceDate;
        $balance->save();

        return redirect('balance');
    }
}
