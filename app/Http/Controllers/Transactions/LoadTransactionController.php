<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class LoadTransactionController extends Controller
{
    public function load($id) {

        $transaction = Transaction::find($id);
        $url = getenv('URL_SERVER');
        $pathBackground = getenv('LOAD_BACKGROUND');


        return view('transactions.load', compact('transaction', 'url', 'pathBackground'));
    }
}
