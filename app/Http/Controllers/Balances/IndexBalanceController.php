<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Models\User;
use App\Models\UserBank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexBalanceController extends Controller
{
    public function index(Request $request)
    {
        $shopkeeper_id = $request->input('shopkeeper_id');
        $urlServer = getenv('URL_SERVER');

        if (isset($shopkeeper_id)) {
            if (Auth::user()->role == 'Administrator') {
                $balances =  Balance::where('user_id', '=', $shopkeeper_id)->orderBy('created_at', 'desc')->get();
                return view('balance.index', compact('balances', 'urlServer'));
            }
        }

        if (Auth::user()->role == 'Administrator') {
            $balances = Balance::whereNull('is_valid')->orderBy('created_at', 'desc')->get();
            $countBalances = $balances->count();
            $balanceModificationData = null;

            if (session()->has('balanceModificationData')) {
                $balanceModificationData = session('balanceModificationData');

                session()->forget('balanceModificationData');
            }

            return view('balance.index', compact('balances', 'countBalances', 'urlServer', 'balanceModificationData'));
        }

        if (Auth::user()->role == 'Saldos') {
            $balances = array();
            $userBanks = UserBank::where('user_id', (Auth::user()->id))->get();

            foreach ($userBanks as $userBank) {
                $collectionAux = Balance::where([
                    ['is_valid', null],
                    ['card_id', $userBank->card_id]
                ])->get();

                foreach ($collectionAux as $balance) {
                    array_push($balances, $balance);
                }
            }

            $balances = collect($balances)->sortByDesc('created_at');
            $countBalances = $balances->count();
            return view('balance.index', compact('balances', 'countBalances','urlServer'));
        }

        if (Auth::user()->role == 'Shopkeeper') {
            $balances = Balance::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }

        if (Auth::user()->role == 'Supplier') {
            $balances = Balance::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        return view('balance.index', compact('balances', 'urlServer'));
    }
}
