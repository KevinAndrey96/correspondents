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

        if (Auth::user()->role == 'Distributor') {
            $transactionCount = Transaction::where('distributor_id', '=', Auth::user()->id)->count();

            $shopkeeperCount = User::where('role', 'like', 'Shopkeeper')->where('distributor_id', '=', Auth::user()->id)->count();

            $shopkeepers = User::where('role', 'like', 'Shopkeeper')->where('distributor_id', '=', Auth::user()->id)->get();
            $shopkeepersBalance = 0;
            foreach($shopkeepers as $shopkeeper){
                $shopkeepersBalance = $shopkeepersBalance + $shopkeeper->balance;
            }
            return view('home', compact(
                'transactionCount',
                'shopkeeperCount',
                'shopkeepersBalance',));
        }

        if (Auth::user()->role == 'Supplier') {
            $transactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->count();
            $successfulTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Successful')->count();
            $failedTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Failed')->count();
            $holdTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Hold')->count();
            $acceptedTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Accepted')->count();
            return view('home', compact(
                'transactionCount',
                'successfulTransactionCount',
                'failedTransactionCount',
                'holdTransactionCount',
                'acceptedTransactionCount',));
        }

        if (Auth::user()->role == 'Shopkeeper') {
            $transactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->count();
            $successfulTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Successful')->count();
            $failedTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Failed')->count();
            $holdTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Hold')->count();
            $acceptedTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Accepted')->count();
            return view('home', compact(
                'transactionCount',
                'successfulTransactionCount',
                'failedTransactionCount',
                'holdTransactionCount',
                'acceptedTransactionCount',));
        }

        return view('home');
    }
}
