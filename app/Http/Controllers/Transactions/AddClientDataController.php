<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AddClientDataController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role == 'Shopkeeper') {
            $productRequirements = "";
            $productID = $request->input('productID');
            $product = Product::find($productID);

            if($product->client_name == 1){
                $productRequirements = $productRequirements.$request->input('clientName').',';
            }
            if($product->client_document == 1){
                $productRequirements = $productRequirements.$request->input('clientDocument').',';
            }
            if($product->email == 1){
                $productRequirements = $productRequirements.$request->input('email').',';
            }
            if($product->code == 1){
                $productRequirements = $productRequirements.$request->input('code').',';
            }
            if($product->extra == 1){
                $productRequirements = $productRequirements.$request->input('extra').',';
            }

            $transaction = new Transaction();
            $transaction->shopkeeper_id = $request->input('shopkeeperID');
            $transaction->distributor_id = $request->input('distributorID');
            $transaction->supplier_id = $request->input('supplierID');
            $transaction->product_id = $productID;
            $transaction->phone_number = $request->input('phoneNumber');
            $transaction->account_number = $request->input('accountNumber');
            $transaction->account_type = $request->input('accountType');
            $transaction->transaction_amount = $request->input('transactionAmount');
            $transaction->transaction_date = $request->input('transactionDate');
            $transaction->transaction_type = $request->input('transactionType');
            $transaction->transaction_state = $request->input('transactionState');
            $transaction->product_requirements = $productRequirements;
            $transaction->save();

            return redirect('home');   
        }
    }
}
