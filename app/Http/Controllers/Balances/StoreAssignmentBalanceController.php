<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;

class StoreAssignmentBalanceController extends Controller
{
    public function __invoke(Request $request)
    {
        $supplier = User::find($request->input('supplier_id'));
        $balance = Balance::find($request->input('balance_id'));
        $balance->is_assigned = 1;
        $balance->save();
        $supplier->balance += $balance->amount;
        $supplier->save();

        return redirect('/balance-all')->with('balanceAssigned', 'El saldo fue asignado al proveedor satisfactoriamente');
    }
}
