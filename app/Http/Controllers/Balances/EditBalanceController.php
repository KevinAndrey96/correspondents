<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditBalanceController extends Controller
{
    public function edit($balanceID)
    {
        $balance = Balance::findOrFail($balanceID);
        return view('balance.edit', compact('balance'));
    }
}
