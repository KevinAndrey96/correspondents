<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;
use Illuminate\Support\Facades\Auth;

class AllBalancesController extends Controller
{
    public function __invoke()
    {
        if (Auth::user()->role == 'Administrator') {
            $balances = Balance::where('type', 'Recharge')
                                ->where('is_valid', 1)
                                ->orWhere('is_valid', 0)
                                ->orderBy('created_at', 'desc')
                                ->paginate(50);
        }

        if (Auth::user()->role == 'Saldos') {
            $balances = Balance::where([
                ['administrator_id', Auth::user()->id],
                ['type', 'Deposit'],
                ['is_valid', 1]
            ])->orWhere([
                ['administrator_id', Auth::user()->id],
                ['type', 'Deposit'],
                ['is_valid', 0]
            ])->orderBy('created_at', 'desc')
                ->paginate(50);
        }

        $urlServer = getenv('URL_SERVER');

        return view('balance.all', ['balances' => $balances, 'urlServer' => $urlServer]);

    }
}
