<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use Illuminate\Support\Facades\Auth;

class IndexCommissionsController extends Controller
{
    public function index(Request $request)
    {
        $shopkeeper_id = $request->input('shopkeeper_id');

        if (isset($shopkeeper_id)) {
            if (Auth::user()->role == 'Administrator') {
                $commissions =  Commission::where('user_id', '=', $shopkeeper_id)->get();

                return view('commissions.index', compact('commissions'));
            }
        }


        if (Auth::user()->role == 'Administrator') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            return view('commissions.index', compact('commissions'));
        }
        if (Auth::user()->role == 'Distributor') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            return view('commissions.index', compact('commissions'));
        }
        if (Auth::user()->role == 'Shopkeeper') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            return view('commissions.index', compact('commissions'));
        }
        if (Auth::user()->role == 'Supplier') {
            $commissions = Commission::where('user_id', '=', Auth::user()->id)->get();
            return view('commissions.index', compact('commissions'));
        }
    }
}
