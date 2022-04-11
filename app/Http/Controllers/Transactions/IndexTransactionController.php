<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexTransactionController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Shopkeeper') {
            $transactions = Transaction::all();
            return view('transactions.index', compact('transactions'));
        }   
    }
}
