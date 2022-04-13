<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditProfitController extends Controller
{
    public function edit($profitID)
    {
        $profit = Profit::findOrFail($profitID);
        return view('profit.edit', compact('profit'));
    }
}
