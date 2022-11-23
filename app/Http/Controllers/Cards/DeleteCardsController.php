<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;

class DeleteCardsController extends Controller
{
    public function __invoke($id)
    {
        Card::destroy($id);

        return back()->with('CardDeleteSuccess', 'Tarjeta de recaudo borrada');
    }
}
