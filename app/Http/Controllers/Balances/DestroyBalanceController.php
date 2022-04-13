<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestroyBalanceController extends Controller
{
    public function destroy($balanceID)
    {
        $balance = Balance::findOrFail($balanceID);
        Balance::destroy($balanceID);
        return redirect('balance');
    }
}
