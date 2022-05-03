<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DetailTransactionController extends Controller
{
    public function detail($id)
    {
        $transaction = Transaction::find($id);
        if (Auth::user()->role == 'Supplier') {
            $transaction->status = 'accepted';
            $transaction->save();
            $extras = explode(',', $transaction->detail);

            return view('transactions.detail', compact('transaction', 'extras'));
        }

        if (Auth::user()->role == 'Shopkeeper') {

            return view('transactions.detail', compact('transaction'));
        }




    }
}
