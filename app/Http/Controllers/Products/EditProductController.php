<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('product.edit', compact('product'));
    }
}
