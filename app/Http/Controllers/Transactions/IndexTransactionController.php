<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexTransactionController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');
        if (isset($id)) {
            if (Auth::user()->role == 'Supplier') {
                $transactions = Transaction::where([
                    ['supplier_id', Auth::user()->id],
                    ['status', 'successful']
                ])
                    ->orWhere([
                        ['supplier_id', Auth::user()->id],
                        ['status', 'failed']
                    ])
                    ->orWhere([
                        ['supplier_id', Auth::user()->id],
                        ['status', 'cancelled']
                    ])
                    ->orderBy('created_at', 'desc')
                    ->get();

                return view('transactions.index', compact('transactions', 'id'));
            }
        }
        if (Auth::user()->role == 'Administrator') {
            $transactions = Transaction::all()->sortByDesc('created_at');//->orderBy('created_at', 'desc')->get();

            return view('transactions.index', compact('transactions'));
        }
        if (Auth::user()->role == 'Shopkeeper') {
            $transactions = Transaction::where('shopkeeper_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

            return view('transactions.index', compact('transactions'));
        }
        if (Auth::user()->role == 'Supplier') {
            $transactions = Transaction::where([
                ['supplier_id', Auth::user()->id],
                ['status',  '<>', 'successful'],
                ['status',  '<>', 'failed'],
                ['status',  '<>', 'cancelled']
            ])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('transactions.index', compact('transactions'));
        }
    }
}
