<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\Commission;
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
            if (doubleval(Auth::user()->balance) < doubleval($request->input('transactionAmount'))) {

                return redirect('/transactions/create')->with('insufficientBalance', 'No tiene saldo suficiente para realizar la transacción');
            }
            $commission = Commission::where([
                ['user_id', '=', Auth::user()->id],
                ['product_id', '=', $productID]
            ])->first();
            if (is_null($commission)) {

                return redirect('/transactions/create')->with('thereIsNotCommission', 'No tiene comisión asignada para este producto');
            }
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
