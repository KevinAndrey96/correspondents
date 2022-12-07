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
        if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos') {
            $balances = Balance::whereNull('is_valid')->orderBy('created_at', 'desc')->get();
            $countBalances = $balances->count();

            return view('balance.index', compact('balances', 'countBalances'));
        }
        if (Auth::user()->role == 'Shopkeeper') {
            $balancesData['balances'] = Balance::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        if (Auth::user()->role == 'Supplier') {
            $balancesData['balances'] = Balance::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        return view('balance.index',$balancesData,);
    }
}
