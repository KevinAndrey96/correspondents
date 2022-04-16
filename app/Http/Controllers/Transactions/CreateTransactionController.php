<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTransactionController extends Controller
{
    public function create()
    {
        if (Auth::user()->role == 'Shopkeeper') {
            $productsDeposit = Product::where('product_type','=','Deposit')->get();
            $productsWithdrawal = Product::where('product_type','=','Withdrawal')->get();
            //dd($productsDeposit);
            return view('transactions.create', compact('productsDeposit', 'productsWithdrawal'));
        } 
    }

}
