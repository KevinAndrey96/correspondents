<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NumberWhatsappTransactionController extends Controller
{
    public function __invoke(Request $request)
    {
        $transactionID = $request->input('transactionID');
        $voucher = $request->input('voucher');
        $message ='Hola, este es el comprobante de la transacción: ';
        return view('transactions/numWP', compact('transactionID', 'voucher', 'message'));
    }
}
