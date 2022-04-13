<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StoreProfitController extends Controller
{
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
}
