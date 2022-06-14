<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class CancelTransactionController extends Controller
{
    public function cancel($id) {
        $transaction = Transaction::find($id);
        $transaction->status = 'cancelled';
        $transaction->save();
        return redirect('/transactions/create')->with('cancelTransactionSuccess', 'Se ha cancelado la transacción');
    }
}
