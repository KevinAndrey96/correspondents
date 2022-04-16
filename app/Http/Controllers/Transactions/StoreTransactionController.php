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
        return $request;
        if (Auth::user()->role == 'Shopkeeper') {
            $fields = [
                'transactionAmount'=>'required|numeric|min:20000|max:200000',
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);

            $shopkeeperID = $request->input('shopkeeperID');
            $distributorID = $shopkeeperID;//hardcode
            $productID = $request->input('productID');
            $product = Product::find($productID);
            $transaction = new Transaction();
            $transaction->shopkeeper_id = $shopkeeperID;
            $transaction->distributor_id = $distributorID;
            $transaction->supplier_id = 2;//hardcode
            $transaction->product_id = $productID;
            $transaction->transaction_amount = $request->input('transactionAmount');
            $transaction->transaction_date = Carbon::now();
            $transaction->transaction_type = $request->input('transactionType');
            $transaction->transaction_state = 'hold';
            return view('transactions.clientDataCreate', compact('transaction', 'product'));
        }
    }

}
