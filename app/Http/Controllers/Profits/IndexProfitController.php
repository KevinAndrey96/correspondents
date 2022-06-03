<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexProfitController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $profitsData['profits'] = Profit::where('is_valid', '=', 1)->orderBy('created_at', 'desc')->get();
        }
        if (Auth::user()->role != 'Administrator') {
            $profitsData['profits'] = Profit::where('user_id', '=', Auth::user()->id)->where('is_valid', '=', 1)->orderBy('created_at', 'desc')->get();
        }
        return view('profit.index', $profitsData);
    }
}
