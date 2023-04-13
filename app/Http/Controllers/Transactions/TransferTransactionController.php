<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransferTransactionController extends Controller
{
    public function __invoke($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'hold';

        if ($transaction->type == 'Deposit') {
            $users = User::where([
                ['role', 'Supplier'],
                ['is_online', 1],
                ['is_enabled', 1],
                ['balance', '>=', $transaction->amount],
                ['id', '!=', Auth::user()->id]
            ])->orderBy('priority', 'asc')->get();
        }

        if ($transaction->type == 'Withdrawal') {
            $users = User::where([
                ['role', 'Supplier'],
                ['is_online', 1],
                ['is_enabled', 1],
                ['id', '!=', Auth::user()->id]
            ])->orderBy('priority', 'asc')->get();
        }

        if ($users->count() === 0) {
            $transaction->supplier_id = null;
            $transaction->status = 'cancelled';
            $transaction->save();

            return redirect('/transactions');
        }

        foreach ($users as $user) {
            $transactions = Transaction::where([
                ['supplier_id', '=', $user->id],
                ['status', '=', 'hold']
            ])->get();

            $numTransactions = $transactions->count();

            if ($numTransactions < $user->max_queue) {
                $transaction->supplier_id = $user->id;
                $transaction->save();

                return redirect('/transactions');
            }
        }
    }
}
