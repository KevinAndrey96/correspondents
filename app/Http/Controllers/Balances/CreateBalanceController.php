<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateBalanceController extends Controller
{
    public function create($userID)
    {
        return view('balance.create', compact('userID'));
    }
}
