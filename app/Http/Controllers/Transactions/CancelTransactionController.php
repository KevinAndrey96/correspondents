<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CancelTransactionController extends Controller
{
    public function cancel($id): Redirector|Application|RedirectResponse
    {
        $transaction = Transaction::find($id);
        if ($transaction->status === 'hold') {
            $transaction->status = 'cancelled';
            $transaction->save();
            return redirect('/transactions/create')->with(
                'cancelTransactionSuccess',
                'Se ha cancelado la transacción'
            );
        }
        return redirect('/transactions/create')->with(
            'cancelTransactionSuccess',
            'No se ha podido cancelar la transacción ya que esta fue tomada por un proveedor'
        );
    }
}
