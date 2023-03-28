<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;

class EditUsersController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        $products = Product::where('product_type', 'like', 'Deposit')->get();
        return view('users.edit', compact('user', 'products'));
    }
}
