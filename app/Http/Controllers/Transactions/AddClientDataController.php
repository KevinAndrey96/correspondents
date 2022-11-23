<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use App\Models\SupplierProduct;
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
                $transaction->date = Carbon::now()->toDateTimeString();
                $dailyTransaction = Transaction::where([
                    ['account_number', '=', $request->input('accountNumber')],
                    ['date', '=', substr($transaction->date, 0, -9)]
                ])->first();
                if (! is_null($dailyTransaction)) {
                    return redirect('/transactions')->with('LimitExceeded', 'Esta cuenta superó el límite de transacciones por día');
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
                $transaction->userIP = \Request::ip();;
                $transaction->save();

                if ($transaction->type === 'Withdrawal') {
                    $suppliers = User::where([
                        ['role', '=', 'Supplier'],
                        ['is_online', '=', 1],
                        ['is_enabled', '=', 1]
                    ])->orderBy('priority', 'asc')->get();
                } else {
                    $suppliers = User::where([
                        ['role', '=', 'Supplier'],
                        ['is_online', '=', 1],
                        ['is_enabled', '=', 1],
                        ['balance', '>=', $transaction->amount]
                    ])->orderBy('priority', 'asc')->get();
                }

                 if ($suppliers->count() === 0) {
                     Transaction::destroy($transaction->id);

                     return redirect('/transactions/create')->with('noSuppliers', 'No hay proveedores disponibles');
                 }

                foreach ($suppliers as $supplier) {
                    $supplierProduct = SupplierProduct::where([
                        ['user_id', $supplier->id],
                        ['product_id', $productID]
                    ])->get();
                    if ($supplierProduct->count() > 0) {
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
                }

                return redirect('/transactions');
            }
        } catch (Exception $e) {
                echo '<h4>No ha asignado todas las comisiones</h4><br/><h4>Ha habido una excepción:</h4>'.$e->getMessage();
        }
    }
}

