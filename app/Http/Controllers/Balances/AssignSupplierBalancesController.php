<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AssignSupplierBalancesController extends Controller
{
    public function __invoke($id)
    {
        $suppliers = User::where('role', 'Supplier')->get();

        return view('balance.assign', ['suppliers' => $suppliers, 'balanceID' => $id]);
    }
}
