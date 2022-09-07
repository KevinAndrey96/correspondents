<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

trait ReassignTransaction
{
    public function reassignTransaction(): void
    {
        $transactionCounter = 0;
        $output = '';
        date_default_timezone_set('America/Bogota');
        $transactions = Transaction::where('status', '=', 'hold')->get();

        $output .= 'Transacciones en este momento: \n\n';
        $output .= json_encode($transactions);
        $output .= ' \n\n';

        foreach ($transactions as $transaction) {
            $wasReassigned = false;
            ++$transactionCounter;
            // Encontramos hace cuantos mínutos se creo esta transacción ya que si se creo hace menos de 1 minuto
            // No es pertinente reasignarla.
            $diffMinutes = $transaction->created_at->diffInMinutes(Carbon::now());

            $output .= '\nTransacción #' . $transactionCounter . '\n';
            $output .= 'Creada hace: ' . $diffMinutes . ' mínutos\n';
            if ($diffMinutes > 1) {
                $output .= '---APTA PARA REASIGNACIÓN---\n';
                $supplier = User::find($transaction->supplier_id);

                if (! is_null($supplier)) {
                    $supplier->is_online = 0;
                    $supplier->save();
                    $output .= 'Actual proveedor: ' . $supplier->id . ' - ' . $supplier->name . ' ...APAGANDO PROVEEDOR...\n';
                }

                $users = User::where([
                    ['role', 'Supplier'],
                    ['is_online', 1],
                    ['is_enabled', 1],
                    ['balance', '>=', $transaction->amount]
                ])->orderBy('priority', 'asc')->get();

                if ($users->count() === 0) {
                    $transaction->supplier_id = null;
                    $transaction->status = 'cancelled';
                    $transaction->save();
                    $output .= 'NO SE ENCONTRÓ PROVEEDOR DISPONIBLE PARA REAGENDAR' . ' ...CANCELANDO TRANSACCIÓN...\n';
                    break;
                }

                $output .= 'PROVEEDORES ENCONTRADOS' . ' ...EVALUANDO PARA REASIGNARLE ESTA TRANSACCIÓN...\n';
                foreach ($users as $user) {
                    $output .= 'Evaluando proveedor #' . $user->id . ' ' . $user->name . '\n';
                    $transactions = Transaction::where([
                        ['supplier_id', '=', $user->id],
                        ['status', '=', 'hold']
                    ])->get();
                    $numTransactions = $transactions->count();
                    $output .= 'Este proveedor tiene asignadas ' . $numTransactions . ' transacciones,  puede recibir un máximo de ' . $user->max_queue .' transacciones\n';

                    if ($numTransactions < $user->max_queue) {
                        $transaction->supplier_id = $user->id;
                        $transaction->save();
                        $wasReassigned = true;
                        $output .= 'REASIGNANDO TRANSACCIÓN A PROVEEDOR ' . $user->id . ' ' . $user->name . '...TRANSACCIÓN REASIGNADA...\n\n';
                        break;
                    }
                }

                if (!$wasReassigned) {
                    $transaction->supplier_id = null;
                    $transaction->status = 'cancelled';
                    $transaction->save();
                    $output .= 'ALERTA: NO SE ENCONTRÓ UN PROVEEDOR APTO PARA REASIGNAR ESTA TRANSACCIÓN. ...TRANSACCIÓN CANCELADA...\n\n';
                }
            }
        }

        $output .= 'EJECUCIÓN TERMINADA CON ÉXITO\n\n';

        $transactions = Transaction::where('status', '=', 'hold')->get();

        $output .= 'Transacciones luego de reasignaciones\n\n';
        $output .= json_encode($transactions);
        $output .= ' \n\n';

        print($output);
    }
}
