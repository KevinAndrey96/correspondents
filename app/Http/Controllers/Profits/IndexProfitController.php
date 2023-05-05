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
        $shopkeeper_id = $request->input('shopkeeper_id');

        if (isset($shopkeeper_id)) {
            if (Auth::user()->role == 'Administrator') {
                $profits =  Profit::where('user_id', '=', $shopkeeper_id)->orderBy('created_at', 'desc')->get();

                return view('profit.index', compact('profits'));
            }
        }

        if (Auth::user()->role == 'Administrator') {
            $profitsData['profits'] = Profit::orderBy('created_at', 'desc')->get();
        } elseif (Auth::user()->role == 'Saldos') {
            $profitsData['profits'] = Profit::where('administrator_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }

        if (Auth::user()->role !== 'Administrator' && Auth::user()->role !== 'Saldos') {
            $profitsData['profits'] = Profit::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }

        return view('profit.index', $profitsData);
    }
}
