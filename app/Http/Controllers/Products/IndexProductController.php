<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_deleted', 0)->get();
        $urlServer = getenv('URL_SERVER');
        $url = $urlServer;

        return view('product.index', compact('products', 'url'));
    }
}
