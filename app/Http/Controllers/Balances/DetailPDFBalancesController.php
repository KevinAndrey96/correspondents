<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DetailPDFBalancesController extends Controller
{
    public function __invoke($id)
    {
        $balance = Balance::find($id);
        $url = getenv('URL_SERVER');
        $balanceOwner = User::find($balance->user_id);

        $pdf = PDF::loadView('balance.detailPDF', ['balance' => $balance, 'url' => $url, 'balanceOwner' => $balanceOwner]);
        $pdf->setPaper(array(0, 0, 141.732, 300), 'portrait');//setPaper(tamaño 5cmx10cm,vertical)
        return $pdf->stream();
    }
}
