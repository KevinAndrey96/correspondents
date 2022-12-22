<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;

class IndexCardsController extends Controller
{
    public function __invoke()
    {
        $cards = Card::all();
        $countryName = getenv('COUNTRY_NAME');

        return view('cards.index', compact('cards','countryName'));
    }
}
