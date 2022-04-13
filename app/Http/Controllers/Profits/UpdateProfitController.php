<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UpdateProfitController extends Controller
{
    public function update(Request $request, $profitID)
    {
        $profit = Profit::findOrFail($profitID);
        $maxWithdrawal = $profit->profit_amount;

        $fields = [
            'profitAmount'=>'required|numeric',
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);
        
        $profitDate = Carbon::now();
        $profitData = [
            'profit_amount' => $request->input('profitAmount'),
            'withdrawal_date' => $profitDate,
            'last_withdrawal_date' => $profit->withdrawal_date,
        ];
        
        Profit::where('id', '=', $profitID)->update($profitData);

        return redirect('profit');
    }
}
