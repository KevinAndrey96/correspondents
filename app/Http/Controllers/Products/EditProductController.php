<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\ProductField;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class EditProductController extends Controller
{
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        $productFields = ProductField::first();

        if (! $product->are_default_fields) {
            $fieldNames = explode( ',',  $product->field_names);
            return view('product.edit', compact('product', 'productFields', 'fieldNames'));

        }

        return view('product.edit', compact('product', 'productFields'));
    }
}
