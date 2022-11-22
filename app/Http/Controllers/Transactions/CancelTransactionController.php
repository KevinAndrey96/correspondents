<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;


class CancelTransactionController extends Controller
{
    public function cancel($id): Redirector|Application|RedirectResponse
    {
        $transaction = Transaction::find($id);
        if ($transaction->status === 'hold') {
            $transaction->status = 'cancelled';
            $transaction->save();
            $user = User::find(Auth::user()->id);
            $user->daily_verified = 0;
            $user->save();
            return redirect('/transactions?id=record')->with(
                'cancelTransactionSuccess',
                'Se ha cancelado la transacción'
            );
        }

        return redirect('/transactions?id=record')->with(
            'cancelTransactionSuccess',
            'No se ha podido cancelar la transacción ya que esta fue tomada por un proveedor'
        );
    }
}
