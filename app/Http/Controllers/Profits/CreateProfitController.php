<?php

namespace App\Http\Controllers\Profits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CreateProfitController extends Controller
{
    public function create()
    {
        $products = Product::where('product_type', 'like', 'Deposit')->get();

        return view('profit.WithdrawProfitController', ['products' => $products]);
    }
}
