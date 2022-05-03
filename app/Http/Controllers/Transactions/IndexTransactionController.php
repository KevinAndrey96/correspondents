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
            $transactions = Transaction::where('shopkeeper_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return view('transactions.index', compact('transactions'));
        }
        if (Auth::user()->role == 'Supplier') {
            $transactions = Transaction::where('supplier_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return view('transactions.index', compact('transactions'));
        }
    }
}
