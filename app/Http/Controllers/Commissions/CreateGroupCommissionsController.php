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

        $commissions = $commissions->map(function($commission){

            if (isset($commission->product->is_deleted) && $commission->product->is_deleted == 1 || isset($commission->product->is_enabled) && $commission->product->is_enabled == 0) {

                return null;
            }

            return $commission;
        })->filter();

        return view('commissions.createGroup', ['commissions' => $commissions]);
    }
}
