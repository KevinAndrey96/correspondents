<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Platform;
use App\Models\Exchange;
use App\Models\SupplierProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTransactionController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::user()->role == 'Shopkeeper') {
            $urlServer = getenv('URL_SERVER');
            $giros = $request->input('giros');
            $platform = Platform::find(1);
            $exchange = Exchange::first();
            $shopkeeperProducts = SupplierProduct::where('user_id', Auth::user()->id)->pluck('product_id');

            $productsDeposit = Product::whereIn('id', $shopkeeperProducts)
                ->where('product_type','=', 'Deposit')
                ->where('is_deleted', 0)
                ->where('is_enabled','=','1')
                ->where('giros', '=', '0')
                ->orderBy('priority', 'asc')
                ->get();

            $productsWithdrawal = Product::whereIn('id', $shopkeeperProducts)
                ->where('product_type','=','Withdrawal')
                ->where('is_deleted', 0)
                ->where('is_enabled','=','1')
                ->orderBy('priority', 'asc')
                ->get();

            if (isset($giros)) {
                $productsDeposit = Product::where('product_type','=','Deposit')
                    ->where('is_deleted', 0)
                    ->where('is_enabled','=','1')
                    ->where('giros', '=', 1)
                    ->orderBy('priority', 'asc')
                    ->get();

                $productsWithdrawal = collect([]);
            }

            $categories = array_filter(array_unique(Product::get()->pluck('category')->toArray()), function($value){
                return $value != null;
            });

            return view('transactions.create', compact('productsDeposit', 'productsWithdrawal', 'platform', 'urlServer', 'giros', 'exchange', 'categories'));
        }
    }

}
