<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;
use App\Models\Summary;
use Illuminate\Support\Facades\Auth;

class StoreAssignmentBalanceController extends Controller
{
    public function __invoke(Request $request)
    {
        $supplier = User::find($request->input('supplier_id'));
        $balance = Balance::find($request->input('balance_id'));
        $balanceOwner = User::find($balance->user->id);
        $balanceOwner->balance += $balance->amount;
        $balance->is_assigned = 1;
        $balance->is_valid = 1;
        $balance->administrator_id = Auth::user()->id;
        $balance->save();
        $summary = new Summary();
        $summary->user_id = $supplier->id;
        $summary->amount = $balance->amount;
        $summary->previous_balance = $supplier->balance;
        $summary->movement_type = 'Deposito Realizado';
        $supplier->balance += $balance->amount;
        $summary->next_balance = $supplier->balance;
        $supplier->save();
        $summary->save();

        return redirect('/balance-all')->with('balanceAssigned', 'El saldo fue asignado al proveedor satisfactoriamente');
    }
}
