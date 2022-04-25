<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateBalanceController extends Controller
{
    public function create()
    {
        if (Auth::user()->role == 'Shopkeeper') {
            return view('balance.addBalanceShopkeeper');
        }
    }
}
