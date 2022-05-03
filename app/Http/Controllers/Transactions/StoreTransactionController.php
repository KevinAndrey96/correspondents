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

            $fields = [
                'transactionAmount'=>'required|numeric|min:20000|max:200000',
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);

            $productID = $request->input('productID');
            $product = Product::find($productID);
            $transaction = new Transaction();
            $transaction->product_id = $productID;
            $transaction->amount = $request->input('transactionAmount');
            $transaction->date = Carbon::now();
            $transaction->type = $request->input('transactionType');
            $transaction->status = 'hold';
            return view('transactions.clientDataCreate', compact('transaction', 'product'));
        }


}
