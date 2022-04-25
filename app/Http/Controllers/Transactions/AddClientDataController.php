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
            $detail = "";
            $productID = $request->input('productID');
            $product = Product::find($productID);

            if($product->account_type == 1){
                $detail = $detail.'Tipo de cuenta:'.$request->input('accountType').',';
            }
            if($product->client_name == 1){
                $detail = $detail.'Nombre:'.$request->input('clientName').',';
            }
            if($product->client_document == 1){
                $detail = $detail.'Documento:'.$request->input('clientDocument').',';
            }
            if($product->email == 1){
                $detail = $detail.'Email:'.$request->input('email').',';
            }
            if($product->code == 1){
                $detail = $detail.'Codigo:'.$request->input('code').',';
            }
            if($product->extra == 1){
                $detail = $detail.'Extra:'.$request->input('extra').',';
            }

            $shopkeeperID = Auth::user()->id;
            $distributorID = Auth::user()->distributor_id;

            $transaction = new Transaction();
            $transaction->shopkeeper_id = $shopkeeperID;
            $transaction->distributor_id = $distributorID;
            $transaction->admin_id = 1;
            $transaction->product_id = $productID;
            $transaction->account_number = $request->input('accountNumber');
            $transaction->amount = $request->input('transactionAmount');
            $transaction->date = $request->input('transactionDate');
            $transaction->type = $request->input('transactionType');
            $transaction->status = $request->input('transactionState');
            $transaction->detail = $detail;
            $transaction->save();





            return redirect('/home');
        }
    }
}
