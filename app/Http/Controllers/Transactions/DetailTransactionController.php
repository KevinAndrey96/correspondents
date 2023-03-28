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
        $callSign = getenv('COUNTRY_CODE');
        $urlServer = getenv('URL_SERVER');
        $transaction = Transaction::find($id);

        if ($transaction->status == 'accepted' && Auth::user()->role == 'Supplier' && $transaction->supplier_id != Auth::user()->id) {

            return redirect('/home')->with('transactionAccepted', 'La transacción ya ha sido aceptada por otro proveedor');
        }

        $extras = explode(',', $transaction->detail);
        if (Auth::user()->role == 'Supplier' && is_null($detailSupplier) && ($transaction->status == 'hold' || $transaction->status == 'accepted')) {
            $transaction->status = 'accepted';
            $transaction->save();

            return view('transactions.detail', compact('transaction', 'extras', 'detailSupplier','callSign', 'urlServer'));
        }
        if (Auth::user()->role == 'Supplier' && ! is_null($detailSupplier)) {

            return view('transactions.detail', compact('transaction', 'extras', 'detailSupplier', 'callSign', 'urlServer'));
        }
        if (Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Administrator') {

            return view('transactions.detail', compact('transaction', 'extras', 'callSign', 'urlServer'));
        }
    }
}
