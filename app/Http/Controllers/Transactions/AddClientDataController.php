<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class AddClientDataController extends Controller
{
    public function store(Request $request)
    {
        try {
            date_default_timezone_set('America/Bogota');
            if (Auth::user()->role == 'Shopkeeper') {
                $detail = "";
                $productID = $request->input('productID');
                $product = Product::find($productID);
                if($product->account_type == 1){
                    $detail = $detail.'Tipo de cuenta: '.$request->input('accountType').',';
                }
                if($product->client_name == 1){
                    $detail = $detail.'Nombre: '.$request->input('clientName').',';
                }
                if($product->client_document == 1){
                    $detail = $detail.'Documento: '.$request->input('clientDocument').',';
                }
                if($product->email == 1){
                    $detail = $detail.'Email: '.$request->input('email').',';
                }
                if($product->code == 1){
                    $detail = $detail.'Codigo: '.$request->input('code').',';
                }
                if($product->extra == 1){
                    $detail = $detail.'Extra: '.$request->input('extra').',';
                }
                $shopkeeperID = Auth::user()->id;
                $distributorID = Auth::user()->distributor_id;
                $transaction = new Transaction();
                //$transaction->date = substr(Carbon::now(), 9, 17);
                $transaction->date = Carbon::now();
                $dailyTransaction = Transaction::where([
                    ['account_number', '=', $request->input('accountNumber')],
                    ['date', '=', substr($transaction->date, 0, -9)]
                ])->first();
                if (! is_null($dailyTransaction)) {
                    return redirect('/transactions')->with('LimitExceeded', 'Esta cuenta super?? el l??mite de transacciones por d??a');
                }
                $transaction->shopkeeper_id = $shopkeeperID;
                $transaction->distributor_id = $distributorID;
                $transaction->admin_id = 1;
                $transaction->product_id = $productID;
                $transaction->account_number = $request->input('accountNumber');
                $transaction->amount = $request->input('transactionAmount');
                $transaction->type = $request->input('transactionType');
                $transaction->status = $request->input('transactionState');
                $transaction->detail = $detail;
                $transaction->save();

                if ($transaction->type === 'Withdrawal') {
                    $suppliers = User::where([
                        ['role', '=', 'Supplier'],
                        ['is_online', '=', 1]
                    ])->orderBy('priority', 'asc')->get();
                } else {
                    $suppliers = User::where([
                        ['role', '=', 'Supplier'],
                        ['is_online', '=', 1],
                        ['balance', '>=', $transaction->amount]
                    ])->orderBy('priority', 'asc')->get();
                }

                foreach ($suppliers as $supplier) {
                    $transactions = Transaction::where([
                                                       ['supplier_id', '=', $supplier->id],
                                                       ['status', '=', 'hold']
                                                       ])->get();
                    $numTransactions = $transactions->count();
                    if ($supplier->max_queue > $numTransactions) {
                        $transaction->supplier_id = $supplier->id;
                        $transaction->save();
                        break;
                    }
                }

                return redirect('/transactions');
            }
        } catch (Exception $e) {
                echo '<h4>No ha asignado todas las comisiones</h4><br/><h4>Ha habido una excepci??n:</h4>'.$e->getMessage();
        }
    }
}

