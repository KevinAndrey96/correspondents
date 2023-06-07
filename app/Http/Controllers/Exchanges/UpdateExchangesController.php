<?php

namespace App\Http\Controllers\Exchanges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exchange;

class UpdateExchangesController extends Controller
{
    public function __invoke(Request $request)
    {
        $exchange = Exchange::find($request->input('exchangeID'));
        $exchange->badge = $request->input('badge');
        $exchange->value = $request->input('value');
        $exchange->save();

        return redirect()->route('exchanges.index');
    }
}
