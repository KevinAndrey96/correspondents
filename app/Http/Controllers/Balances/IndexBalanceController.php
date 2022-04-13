<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexBalanceController extends Controller
{
    public function index()
    {
        $balancesData['balances'] = Balance::all();
        return view('balance.index',$balancesData);
    }
}
