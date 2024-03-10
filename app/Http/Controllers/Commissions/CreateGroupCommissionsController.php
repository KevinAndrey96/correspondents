<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateGroupCommissionsController extends Controller
{
    public function __invoke()
    {
        $commissions = Commission::with('product')->where('user_id', Auth::user()->id)->get();

        return $commissions;

        $commissions = $commissions->map(function($commission){
            if ($commission->product->is_deleted == 1 || $commission->product->is_enabled == 0) {

                return null;
            }

            return $commission;
        })->filter();

        //$products = Product::where('is_enabled', 1)->get();

        return view('commissions.createGroup', ['commissions' => $commissions]);
    }
}
