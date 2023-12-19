<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\SupplierProduct;
use Illuminate\Support\Facades\Auth;

class AssignProductsController extends Controller
{
    public function __invoke($id)
    {
        $products = Product::all();
        $supplierProducts = SupplierProduct::where('user_id', $id)->get();
        $distributorProducts = SupplierProduct::where('user_id', Auth::user()->id)->get();

        return view('product.assign', compact('id', 'products', 'supplierProducts', 'distributorProducts'));
    }
}
