<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use Illuminate\Support\Facades\Auth;

class IndexCommissionsController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Administrator') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            return view('commissions.index', compact('commissions'));
        }
        if (Auth::user()->role == 'Distributor') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            $commissionsTotal= 0;
            $commissionsTotal = Commission::where('user_id', '=', Auth::user()->id)->sum('amount');
            return view('commissions.index', compact('commissions','commissionsTotal'));
        }
        if (Auth::user()->role == 'Shopkeeper') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            $commissionsTotal= 0;
            $commissionsTotal = Commission::where('user_id', '=', Auth::user()->id)->sum('amount');
            return view('commissions.index', compact('commissions','commissionsTotal'));
        }
        if (Auth::user()->role == 'Supplier') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            $commissionsTotal= 0;
            $commissionsTotal = Commission::where('user_id', '=', Auth::user()->id)->sum('amount');
            return view('commissions.index', compact('commissions','commissionsTotal'));
        }
    }
}
