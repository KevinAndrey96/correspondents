<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class CancelTransactionController extends Controller
{
    public function cancel($id) {
        $transaction = Transaction::find($id);
        $transaction->status = 'failed';
        $transaction->save();
        return back();
    }
}
