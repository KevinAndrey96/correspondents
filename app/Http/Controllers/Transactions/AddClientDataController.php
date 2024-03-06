<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use App\Models\SupplierProduct;
use App\Models\Exchange;
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
                $giros = intval($request->input('giros'));

                if ($product->account_type == 1){
                    $detail = $detail.'Tipo de cuenta: '.$request->input('accountType').',';
                }

                if ($product->client_name == 1){
                    $detail = $detail.'Nombre: '.$request->input('clientName').',';
                }

                if ($product->client_document == 1){
                    $detail = $detail.'Documento: '.$request->input('clientDocument').',';
                }

                if ($product->email == 1){
                    $detail = $detail.'Email: '.$request->input('email').',';
                }

                if ($product->code == 1){
                    $detail = $detail.'Codigo: '.$request->input('code').',';
                }

                if ($product->extra == 1){
                    $detail = $detail.'Extra: '.$request->input('extra').',';
                }

                if (! $product->are_default_fields) {
                    foreach ($request->except([
                        '_token',
                        'productID',
                        'accountType',
                        'clientName',
                        'clientDocument',
                        'email',
                        'code',
                        'transactionAmount',
                        'transactionDate',
                        'transactionType',
                        'transactionState',
                        'accountNumber',
                        'accountType',
                        'email',
                        'own_commission',
                        'giros',
                        'extra']) as $index => $value) {
                        $detail .= str_replace('_', ' ',$index.': '.$value.',');
                    }
                }

                $shopkeeperID = Auth::user()->id;
                $distributorID = Auth::user()->distributor_id;
                $transaction = new Transaction();
                $transaction->date = Carbon::now()->toDateTimeString();

                if ($giros == 1) {
                    $transaction->giros = 1;
                }

                $allowedTransaction = 0;
                $i = 0;
                $firstTransactions =  Transaction::where([
                    ['account_number', '=', $request->input('accountNumber')],
                    ['product_id', '=', $request->input('productID')],
                    ['first_transaction', '=', 1]
                ])->get();

                if ($firstTransactions->count() == 0) {
                    $transaction->first_transaction = 1;
                    $allowedTransaction = 1;
                } else {
                    $accountTransactions = Transaction::where([
                            ['account_number', '=', $request->input('accountNumber')],
                            ['product_id', '=', $request->input('productID')]
                        ])
                        ->orderBy('updated_at', 'desc')
                        ->get();

                    foreach ($accountTransactions as $accountTransaction) {
                        $i++;
                        if ($accountTransaction->first_transaction == 1) {
                            $firstTransaction = $accountTransaction;
                            break;
                        }
                    }

                    if ($i < $product->num_jineteo) {
                        $diffHours = $firstTransaction->updated_at->diffInHours(Carbon::now());
                        if ($diffHours >= $product->hours) {
                            $allowedTransaction = 1;
                            $transaction->first_transaction = 1;
                        } else {
                            $allowedTransaction = 1;
                            $transaction->first_transaction = 0;
                        }
                    } else {
                        $diffHours = $firstTransaction->updated_at->diffInHours(Carbon::now());
                        if ($diffHours >= $product->hours) {
                            $allowedTransaction = 1;
                            $transaction->first_transaction = 1;
                        } else {
                            $allowedTransaction = 0;
                            $allowedHour = Carbon::parse($firstTransaction->updated_at)->addHours($product->hours)->format('h:i A');
                        }
                    }
                }

                if ($allowedTransaction == 0) {
                    if (isset($giros)) {
                        return redirect('/giros/create?giros=1')->with('LimitExceeded', 'Esta cuenta superó el límite de giros por periodo, podra realizar giros con la misma a partir de las '.$allowedHour);
                    } else {
                        return redirect('/transactions')->with('LimitExceeded', 'Esta cuenta superó el límite de transacciones por periodo, podra realizar transacciones con la misma a partir de las '.$allowedHour);
                    }
                }

                $transaction->shopkeeper_id = $shopkeeperID;
                $transaction->distributor_id = $distributorID;
                $transaction->admin_id = 1;
                $transaction->product_id = $productID;
                $transaction->account_number = $request->input('accountNumber');
                $transaction->amount = (double)$request->input('transactionAmount');

                if (getenv('COUNTRY_NAME') == 'ECUADOR' && $transaction->giros == 1) {
                    $exchange = Exchange::find(1);
                    $transaction->amount = (double)($request->input('transactionAmount')) * (double)($exchange->value);
                }

                $transaction->type = $request->input('transactionType');
                $transaction->status = $request->input('transactionState');
                $transaction->detail = $detail;
                $transaction->own_commission = $request->input('own_commission');
                $transaction->userIP = \Request::ip();
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

                    if ($transaction->giros == 1) {
                        $suppliers = User::where([
                            ['role', '=', 'Supplier'],
                            ['is_online', '=', 1],
                            ['is_enabled', '=', 1],
                            ['balance', '>=', ($transaction->amount)/($exchange->value)]
                        ])->orderBy('priority', 'asc')->get();
                    }

                }

                 if ($suppliers->count() === 0) {
                     Transaction::destroy($transaction->id);
                     if (isset($giros)) {
                         return redirect('/giros/create?giros=1')->with('noSuppliers', 'No hay proveedores disponibles');
                     } else {
                         return redirect('/transactions/create')->with('noSuppliers', 'No hay proveedores disponibles');
                     }
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
                if (isset($giros)) {
                    return redirect('/transactions?giros=1');
                } else {
                    return redirect('/transactions');
                }
            }
        } catch (Exception $e) {
                echo '<h4>No ha asignado todas las comisiones</h4><br/><h4>Ha habido una excepción:</h4>'.$e->getMessage();
        }
    }
}

