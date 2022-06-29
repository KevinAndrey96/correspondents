<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DetailTransactionPDFController extends Controller
{
    public function detailPDF($id)
    {
        $transaction = Transaction::find($id);
        if (Auth::user()->role == 'Supplier' and Auth::user()->id == $transaction->supplier_id) {
            $extras = explode(',', $transaction->detail);

            $pdf = PDF::loadView('transactions.detailPDF', ['transaction'=>$transaction, 'extras'=>$extras]);
            $pdf->setPaper(array(0, 0, 141.732, 800), 'portrait');//setPaper(tamaño 5cmx10cm,vertical)
            return $pdf->stream();
        }
        if (Auth::user()->role == 'Shopkeeper' and Auth::user()->id == $transaction->shopkeeper_id) {
            $extras = explode(',', $transaction->detail);

            $pdf = PDF::loadView('transactions.detailPDF', ['transaction'=>$transaction, 'extras'=>$extras]);
            $pdf->setPaper(array(0, 0, 141.732, 250), 'portrait');//setPaper(tamaño 5cmx10cm,vertical)
            return $pdf->stream();
        }
    }
}
