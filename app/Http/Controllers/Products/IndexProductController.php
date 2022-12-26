<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $countryName = getenv('COUNTRY_NAME');

        if ($countryName == 'COLOMBIA') {
            $url = 'https://corresponsales.asparecargas.net';
        }

        if ($countryName == 'ECUADOR') {
            $url = 'https://transacciones.asparecargas.net';
        }

        return view('product.index', compact('products', 'url'));
    }
}
