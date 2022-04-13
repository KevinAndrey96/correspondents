<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexProductController extends Controller
{
    public function index()
    {
        $productsData['products'] = Product::all();
        return view('product.index',$productsData);
    }
}
