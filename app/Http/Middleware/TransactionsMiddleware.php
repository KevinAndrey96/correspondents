<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
class TransactionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('impersonated_by')) {
            return $next($request);
        }

        if (Auth::user()->role == 'Shopkeeper') {
            $transaction = Transaction::where([['shopkeeper_id', '=',  Auth::user()->id], ['status', '=', 'hold']])
                                        ->orWhere([['shopkeeper_id', '=',  Auth::user()->id], ['status', '=', 'accepted']])->first();
            if (! is_null($transaction)) {

                return redirect('/transactionLoad/'.$transaction->id);
            }

            return $next($request);
        }

        if (Auth::user()->role == 'Supplier') {
            $transaction = Transaction::where([['supplier_id',  Auth::user()->id], ['status', 'accepted']])->first();
            if (! is_null($transaction)) {

                return redirect('/transaction/detail/' . $transaction->id);
            }
        }

        return $next($request);
    }
}
