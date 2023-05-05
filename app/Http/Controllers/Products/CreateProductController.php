<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\ProductField;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    public function create()
    {
        $productFields = ProductField::first();

        return view('product.create', compact('productFields'));
    }
}
