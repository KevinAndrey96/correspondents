<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Commission;
use App\Models\User;

class CreateCommissionsController extends Controller
{
    public function create($id)
    {
        $user = User::find($id);
        $products = Product::all();
        foreach ($products as $product) {
            $commission = Commission::where('user_id', '=', $id)
                ->where('product_id', '=', $product->id)
                ->first();
            if (is_null($commission)) {
                $commission = new Commission();
                $commission->user_id = $id;
                $commission->product_id = $product->id;
                $commission->amount = 0;
                $commission->save();
            }
        }
        $commissions = Commission::where('user_id', '=', $id)->get();

        return view('commissions.create', compact('commissions', 'user'));
    }

}
