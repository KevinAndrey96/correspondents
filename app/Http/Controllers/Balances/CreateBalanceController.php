<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class CreateBalanceController extends Controller
{
    public function create()
    {
        if (Auth::user()->role == 'Shopkeeper' or Auth::user()->role == 'Supplier') {
            $cards = Card::all();
            $countryName = getenv('COUNTRY_NAME');

            return view('balance.addBalanceShopkeeper', compact('cards', 'countryName'));
        }
    }
}
