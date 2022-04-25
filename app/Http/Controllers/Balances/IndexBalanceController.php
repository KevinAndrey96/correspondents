<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexBalanceController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Administrator') {
            $balancesData['balances'] = Balance::all();
            return view('balance.index',$balancesData);
        }
    }
}
