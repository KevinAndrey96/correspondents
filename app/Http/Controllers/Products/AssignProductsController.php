<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\SupplierProduct;

class AssignProductsController extends Controller
{
    public function __invoke($id)
    {
        $products = Product::all();
        $supplierProducts = SupplierProduct::where('user_id', $id)->get();

        return view('product.assign', compact('id', 'products', 'supplierProducts'));
    }
}
