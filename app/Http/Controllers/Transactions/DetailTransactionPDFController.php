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
            $extras = explode(',', $transaction->detail);
            $url = getenv('URL_SERVER');


            $pdf = PDF::loadView('transactions.detailPDF', ['transaction'=>$transaction, 'extras'=>$extras, 'url'=>$url]);
            $pdf->setPaper(array(0, 0, 141.732, 300), 'portrait');//setPaper(tamaño 5cmx10cm,vertical)
            return $pdf->stream();

    }
}
