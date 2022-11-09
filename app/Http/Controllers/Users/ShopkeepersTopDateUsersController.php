<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class ShopkeepersTopDateUsersController extends Controller
{
    public function __invoke()
    {
        $transactions = Transaction::all();
        $years = array();

        foreach ($transactions as $transaction) {
            $year = substr($transaction->created_at,0,-15);
            array_push($years, intVal($year));

        }
        $years = array_unique($years);
        sort($years);

        return view('users.shopkeeperTopDate', compact('years'));
    }
}
