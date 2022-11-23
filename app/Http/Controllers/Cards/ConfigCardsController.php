<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigCardsController extends Controller
{
    public function __invoke()
    {
        return view('cards.create');
    }
}
