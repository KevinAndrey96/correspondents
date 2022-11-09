<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShopkeepersTopUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $shopkeepers = array();
        $transactions = DB::table('transactions')
                        ->where([
                            ['created_at', 'like', $year.'-'.$month.'%'],
                            ['status', 'successful']
                        ])
                        ->select(DB::raw('sum(amount) as acum, count(*) as num_transactions, transactions.shopkeeper_id'))
                        ->groupBy('shopkeeper_id')
                        ->orderBy('acum', 'desc')
                        ->get();

        foreach ($transactions as $transaction) {
          $user = User::find($transaction->shopkeeper_id);
          array_push($shopkeepers, $user);
        }


        return view('users.shopkeeperTop', compact('transactions', 'shopkeepers'));
    }
}
