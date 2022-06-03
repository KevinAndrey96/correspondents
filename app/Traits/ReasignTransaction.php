<?php
namespace App\Traits;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

trait ReasignTransaction
{
    public function reasignTransaction()
    {
        date_default_timezone_set('America/Bogota');
        $transactions = Transaction::where('status', '=', 'hold')->get();
        foreach ($transactions as $transaction) {
            $diffMinutes = $transaction->created_at->diffInMinutes(Carbon::now());
            if ($diffMinutes >= 4) {
                $supplier = User::find($transaction->supplier_id);
                if (! is_null($supplier)) {
                    $supplier->is_online = 0;
                    $supplier->save();
                }
                $users = User::where('is_online', '=', 1)->orderBy('priority', 'asc')->get();
                if (is_null($users)) {
                    $transaction->supplier_id = null;
                    $transaction->status = 'failed';
                    $transaction->save();
                    break;
                }
                foreach ($users as $user) {
                    $transactions = Transaction::where([
                        ['supplier_id', '=', $user->id],
                        ['status', '=', 'hold']
                    ])->get();
                    $numTransactions = $transactions->count();
                    if ($numTransactions < $user->max_queue) {
                        $transaction->supplier_id = $user->id;
                        $transaction->save();
                        break;
                    }
                }
            }
        }
    }
}
