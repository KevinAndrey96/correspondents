<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\SupplierProduct;
use Illuminate\Support\Facades\Auth;

class IndexCommissionsController extends Controller
{
    public function index(Request $request)
    {
        $shopkeeper_id = $request->input('shopkeeper_id');
        $userProducts = SupplierProduct::where('user_id', Auth::user()->id)->get();
        $productIDS = $userProducts->pluck('product_id')->toArray();
        $commissions = Commission::where('user_id', '=', Auth::user()->id)
            ->whereIn('product_id', $productIDS)
            ->get();

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

        return view('commissions.index', compact('commissions'));
    }
}
