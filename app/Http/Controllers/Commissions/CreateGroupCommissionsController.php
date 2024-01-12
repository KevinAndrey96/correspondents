<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CreateGroupCommissionsController extends Controller
{
    public function __invoke()
    {
        $products = Product::where('is_enabled', 1)->get();

        return view('commissions.createGroup', ['products' => $products]);
    }
}
