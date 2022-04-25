<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowBalanceUsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', '=', 'Shopkeeper')->orWhere('role', '=', 'Supplier')->get();
        return view('balance.showBalanceUsers', compact('users'));
    }
}
