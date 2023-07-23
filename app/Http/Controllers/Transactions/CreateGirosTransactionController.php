<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Platform;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateGirosTransactionController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::user()->role == 'Shopkeeper') {
            $urlServer = getenv('URL_SERVER');
            $giros = $request->input('giros');

            $productsDeposit = Product::where('product_type','=','Deposit')
                ->where('is_enabled','=','1')
                ->where('giros', '=', '0')
                ->orderBy('priority', 'asc')
                ->get();

            $productsWithdrawal = Product::where('product_type','=','Withdrawal')
                ->where('is_enabled','=','1')
                ->orderBy('priority', 'asc')
                ->get();

            $platform = Platform::find(1);

            if (isset($giros)) {
                $productsDeposit = Product::where('product_type','=','Deposit')
                    ->where('is_enabled','=','1')
                    ->where('giros', '=', 1)
                    ->orderBy('priority', 'asc')
                    ->get();

                $productsWithdrawal = collect([]);
            }

            $exchange = Exchange::first();

            return view('transactions.createGiros', compact('productsDeposit', 'productsWithdrawal', 'platform', 'urlServer', 'giros', 'exchange'));
        }
    }
}
