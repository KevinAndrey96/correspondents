<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class LoadTransactionController extends Controller
{
    public function load($id) {

        $transaction = Transaction::find($id);
        $countryName = getenv('COUNTRY_NAME');
        $pathBackground = getenv('LOAD_BACKGROUND');

        if ($countryName == 'COLOMBIA') {
            $url = 'https://corresponsales.asparecargas.net';
        }
        if ($countryName == 'ECUADOR') {
            $url = 'https://transacciones.asparecargas.net';
        }

        return view('transactions.load', compact('transaction', 'url', 'pathBackground'));
    }
}
