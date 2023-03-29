<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;

class AllBalancesController extends Controller
{
    public function __invoke()
    {
        $balances = Balance::where([
            ['type', 'Deposit'],
            ['is_valid', 1]
        ])->orderBy('created_at', 'desc')->paginate(50);

        $urlServer = getenv('URL_SERVER');

        return view('balance.all', ['balances' => $balances, 'urlServer' => $urlServer]);

    }
}
