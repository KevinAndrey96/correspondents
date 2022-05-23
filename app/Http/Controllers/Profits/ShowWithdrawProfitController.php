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
        if (Auth::user()->role == 'Administrator') {
            $profitsData['profits'] = Profit::all()->sortByDesc('created_at');
            return view('profit.showProfitUsers', $profitsData);
        }
    }
}
