<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UpdateBalanceController extends Controller
{
    public function update(Request $request, $balanceID)
    {
        $fields = [
            'balanceAmount'=>'required|numeric|min:1.0',
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $balance = Balance::findOrFail($balanceID);
        $balanceDate = Carbon::now();

        $balanceData = [
            'balance_amount' => $request->input('balanceAmount'),
            'balance_date' => $balanceDate,
            'last_balance_amount' => $balance->balance_amount,
            'last_balance_date' => $balance->balance_date,
        ];

        Balance::where('id', '=', $balanceID)->update($balanceData);

        return redirect('balance');
    }
}
