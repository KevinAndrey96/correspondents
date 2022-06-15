<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ChangeStatusProductsController extends Controller
{
    public function changeStatus(Request $request)
    {
        //return $request;
        $product = Product::find($request->input('id'));
        $product->is_enabled = $request->input('status');
        $product->save();

        return back();
    }
}
