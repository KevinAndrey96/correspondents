<?php

namespace App\Http\Controllers\Exchanges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exchange;

class IndexExchangesController extends Controller
{
    public function __invoke()
    {
        $exchange = Exchange::find(1);

        return view('exchanges.index', compact('exchange'));
    }
}
