<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CreateBalanceAdminController extends Controller
{
    public function create($userID)
    {
        $user = User::findOrFail($userID);
        return view('balance', compact('user'));
    }
}
