<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductField;

class FieldsProductsController extends Controller
{
    public function __invoke()
    {
        $productFields = ProductField::first();

        return view('product.fields', compact('productFields'));
    }
}
