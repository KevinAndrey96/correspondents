<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateBalanceAdminController extends Controller
{
    public function create($userID)
    {
        if (Auth::user()->role == 'Administrator') {
            $user = User::findOrFail($userID);
            return view('balance.addBalanceAdmin', compact('user'));
        }
    }
}
