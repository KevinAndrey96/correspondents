<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class LoadTransactionController extends Controller
{
    public function load($id) {

        $transaction = Transaction::find($id);
        return view('transactions.load', compact('transaction'));
    }
}
