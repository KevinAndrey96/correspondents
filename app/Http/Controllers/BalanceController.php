<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BalanceController extends Controller
{

    public function index()
    {
        $balancesData['balances'] = Balance::all();
        return view('balance.index',$balancesData);
    }

    public function create($userID)
    {
        return view('balance.create', compact('userID'));
    }

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

    public function show(Balance $balance)
    {
        //
    }

    public function edit($balanceID)
    {
        $balance = Balance::findOrFail($balanceID);
        return view('balance.edit', compact('balance'));
    }

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

    public function destroy($balanceID)
    {
        $balance = Balance::findOrFail($balanceID);
        Balance::destroy($balanceID);
        return redirect('balance');
    }
}
