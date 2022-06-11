<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DetailTransactionController extends Controller
{
    public function detail($id, Request $request)
    {
        $detailSupplier = $request->input('detail');
        $transaction = Transaction::find($id);
        $extras = explode(',', $transaction->detail);
        if (Auth::user()->role == 'Supplier' && is_null($detailSupplier) && ($transaction->status == 'hold' || $transaction->status == 'accepted')) {
            $transaction->status = 'accepted';
            $transaction->save();

            return view('transactions.detail', compact('transaction', 'extras', 'detailSupplier'));
        }
        if (Auth::user()->role == 'Supplier' && ! is_null($detailSupplier)) {

            return view('transactions.detail', compact('transaction', 'extras', 'detailSupplier'));
        }
        if (Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Administrator') {

            return view('transactions.detail', compact('transaction', 'extras'));
        }
    }
}
