<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProfitController extends Controller
{

    public function index()
    {
        $profitsData['profits'] = Profit::all();
        return view('profit.index',$profitsData);
    }

    public function create($userID)
    {
        return view('profit.create', compact('userID'));
    }

    public function store(Request $request)
    {
        $fields = [
            'userID'=>'required',
            'profitAmount'=>'required|numeric|min:1.0',
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $withdrawalFirstDate = Carbon::now();

        $profit = new Profit();
        $profit->user_id = $request->input('userID');
        $profit->profit_amount = $request->input('profitAmount');
        $profit->withdrawal_date = $withdrawalFirstDate;
        
        $profit->save();

        return redirect('profit');
    }

    public function show(Profit $profit)
    {
        //
    }

    public function edit($profitID)
    {
        $profit = Profit::findOrFail($profitID);
        return view('profit.edit', compact('profit'));
    }

    public function update(Request $request, $profitID)
    {
        $profit = Profit::findOrFail($profitID);
        $maxWithdrawal = $profit->profit_amount;

        $fields = [
            'profitAmount'=>'required|numeric|max:'.$maxWithdrawal,
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);
        
        $profitDate = Carbon::now();
        $profitData = [
            'profit_amount' => $profit->profit_amount-$request->input('profitAmount'),
            'withdrawal_date' => $profitDate,
            'last_withdrawal_date' => $profit->withdrawal_date,
        ];
        
        Profit::where('id', '=', $profitID)->update($profitData);

        return redirect('profit');
    }

    public function destroy($profitID)
    {
        $profit = Profit::findOrFail($profitID);
        Profit::destroy($profitID);
        return redirect('profit');
    }
}
