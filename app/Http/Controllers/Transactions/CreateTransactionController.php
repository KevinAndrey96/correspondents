<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTransactionController extends Controller
{
    public function create($shopkeeperID)
    {
        if (Auth::user()->role == 'Shopkeeper') {
            $products = Product::all();
            return view('transactions.create', compact('shopkeeperID', 'products'));
        } 
    }

}
