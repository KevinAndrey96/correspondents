<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AssignProductsController extends Controller
{
    public function __invoke($id)
    {
        $products = Product::all();

        return view('product.assign', compact('id', 'products'));
    }
}
