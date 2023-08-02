<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Transaction;
use App\Models\SupplierProduct;
use App\Models\Exchange;

use Carbon\Carbon;

trait ReassignTransaction
{
    public function reassignTransaction(): void
    {

        $transactionCounter = 0;
        $output = '';
        date_default_timezone_set('America/Bogota');
        $transactions = Transaction::where('status', '=', 'hold')->get();
        $existsTransactions = $transactions->count() !== 0;
        $exchange = Exchange::find(1);

        $output .= 'Transacciones en este momento:
        ';
        $output .= json_encode($transactions);
        $output .= '

        ';

        foreach ($transactions as $transaction) {
            $wasReassigned = false;
            ++$transactionCounter;

            $diffMinutes = $transaction->created_at->diffInMinutes(Carbon::now());

            $output .= 'Transacción #' . $transactionCounter . '
            ';
            $output .= 'Creada hace: ' . $diffMinutes . ' mínutos
            ';
            if ($diffMinutes > $transaction->product->reassignment_minutes-1) {
                $output .= '---APTA PARA REASIGNACIÓN---
                ';
                $supplier = User::find($transaction->supplier_id);

                if (! is_null($supplier)) {
                    $supplier->is_online = 0;
                    $supplier->save();
                    $output .= 'Actual proveedor: #' . $supplier->id . ' - ' . $supplier->name . ' ...APAGANDO PROVEEDOR...
                    ';
                }

                //TODO Aquí valida el saldo pero no el tipo de transacción

                if ($transaction->type == 'Deposit') {
                    $users = User::where([
                        ['role', 'Supplier'],
                        ['is_online', 1],
                        ['is_enabled', 1],
                        ['balance', '>=', $transaction->amount]
                    ])->orderBy('priority', 'asc')->get();

                    if ($transaction->giros == 1) {
                        $users = User::where([
                            ['role', 'Supplier'],
                            ['is_online', 1],
                            ['is_enabled', 1],
                            ['balance', '>=', ($transaction->amount)/$exchange->value]
                        ])->orderBy('priority', 'asc')->get();
                    }
                }

                if ($transaction->type == 'Withdrawal') {
                    $users = User::where([
                        ['role', 'Supplier'],
                        ['is_online', 1],
                        ['is_enabled', 1],
                    ])->orderBy('priority', 'asc')->get();
                }

                if ($users->count() === 0) {
                    $transaction->supplier_id = null;
                    $transaction->status = 'cancelled';
                    $transaction->save();
                    $output .= 'NO SE ENCONTRÓ PROVEEDOR DISPONIBLE PARA REAGENDAR' . ' ...CANCELANDO TRANSACCIÓN...
                    ';
                    break;
                }

                $output .= 'PROVEEDORES ENCONTRADOS' . ' ...EVALUANDO PARA REASIGNARLE ESTA TRANSACCIÓN...
                ';
                foreach ($users as $user) {
                    $output .= 'Evaluando proveedor #' . $user->id . ' - ' . $user->name . '
                    ';
                    $supplierProduct = SupplierProduct::where([
                        ['user_id', $user->id],
                        ['product_id', $transaction->product->id]
                    ])->get();

                    if ($supplierProduct->count() > 0) {
                        $transactions = Transaction::where([
                            ['supplier_id', '=', $user->id],
                            ['status', '=', 'hold']
                        ])->get();
                        $numTransactions = $transactions->count();
                        $output .= 'Este proveedor tiene asignadas ' . $numTransactions . ' transacciones,  puede recibir un máximo de ' . $user->max_queue . ' transacciones
                            ';

                        if ($numTransactions < $user->max_queue) {
                            $transaction->supplier_id = $user->id;
                            $transaction->save();
                            $wasReassigned = true;
                            $output .= 'REASIGNANDO TRANSACCIÓN A PROVEEDOR ' . $user->id . ' ' . $user->name . '...TRANSACCIÓN REASIGNADA...
                            ';
                            break;
                        }
                    }
                }
                if (! $wasReassigned) {
                    $transaction->supplier_id = null;
                    $transaction->status = 'cancelled';
                    $transaction->save();
                    $output .= 'ALERTA: NO SE ENCONTRÓ UN PROVEEDOR APTO PARA REASIGNAR ESTA TRANSACCIÓN. ...TRANSACCIÓN CANCELADA...

                    ';
                }
            }
        }

        $output .= 'EJECUCIÓN TERMINADA CON ÉXITO

        ';

        $transactions = Transaction::where('status', '=', 'hold')->get();

        $output .= 'Transacciones luego de reasignaciones
        ';
        $output .= json_encode($transactions);
        $output .= '

        ';

        if ($existsTransactions) {
            print($output);
        }
    }
}
