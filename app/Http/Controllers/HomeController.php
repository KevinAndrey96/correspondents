<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'Administrator') {
            $transactionCount = Transaction::all()->count();
            $successfulTransactionCount = Transaction::where('status', 'like', 'Successful')->count();
            $failedTransactionCount = Transaction::where('status', 'like', 'Failed')->count();
            $holdTransactionCount = Transaction::where('status', 'like', 'Hold')->count();
            $acceptedTransactionCount = Transaction::where('status', 'like', 'Accepted')->count();

            $administratorCount = User::where('role', 'like', 'Administrator')->count();
            $shopkeeperCount = User::where('role', 'like', 'Shopkeeper')->count();
            $supplierCount = User::where('role', 'like', 'Supplier')->count();
            $distributorCount = User::where('role', 'like', 'Distributor')->count();

            $shopkeepers = User::where('role', 'like', 'Shopkeeper')->get();
            $shopkeepersBalance = 0;
            foreach($shopkeepers as $shopkeeper){
                $shopkeepersBalance = $shopkeepersBalance + $shopkeeper->balance;
            }
            $suppliers = User::where('role', 'like', 'Supplier')->get();
            $suppliersBalance = 0;
            foreach($suppliers as $supplier){
                $suppliersBalance = $suppliersBalance + $supplier->balance;
            }
            return view('home', compact(
                'transactionCount',
                'successfulTransactionCount',
                'failedTransactionCount',
                'holdTransactionCount',
                'acceptedTransactionCount',
                'administratorCount',
                'shopkeeperCount',
                'supplierCount',
                'distributorCount',
                'shopkeepersBalance',
                'suppliersBalance'));
        }
        return view('home');
    }
}
