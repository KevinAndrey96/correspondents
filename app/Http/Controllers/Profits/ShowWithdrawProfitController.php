<?php

namespace App\Http\Controllers\Profits;

use App\Http\Controllers\Controller;
use App\Models\Profit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowWithdrawProfitController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos') {
            $profits = Profit::all()->sortByDesc('created_at');
            $countProfits = Profit::where('is_valid',null)->get()->count();
            $countryName = getenv('COUNTRY_NAME');

            return view('profit.showProfitUsers', compact('profits', 'countProfits', 'countryName'));
        }
    }
}
