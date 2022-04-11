<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StoreTransactionController extends Controller
{

    public function store(Request $request)
    {        
        if (Auth::user()->role == 'Shopkeeper') {
            $shopkeeperID = $request->input('shopkeeperID');
            $distributorID = $shopkeeperID;//User::where('id', '=', $shopkeeperID)->get()->distributor_id;
            $productID = $request->input('productID');
            $product = Product::find($productID);

            $transaction = new Transaction();
            $transaction->shopkeeper_id = $shopkeeperID;
            $transaction->distributor_id = $distributorID;
            $transaction->supplier_id = 2;
            $transaction->product_id = $productID;
            $transaction->client_name = $request->input('clientName');
            $transaction->client_document = $request->input('clientDocument');
            $transaction->transaction_amount = $request->input('transactionAmount');
            $transaction->transaction_date = $request->input('transactionDate');
            $transaction->transaction_type = $request->input('transactionType');
            $transaction->transaction_state = $request->input('transactionState');

            return view('transactions.clientDataCreate', compact('transaction', 'product'));   
        }
    }

}
