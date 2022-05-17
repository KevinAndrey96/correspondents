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
        if (Auth::user()->role == 'Shopkeeper') {
            $transaction = Transaction::where([['shopkeeper_id', '=',  Auth::user()->id], ['status', '=', 'hold']])->first();
            if (! is_null($transaction)) {
                return redirect('/transactionLoad/'.$transaction->id);
            }
            return $next($request);

        }


            /*$transaction = Transaction::where([['shopkeeper_id','=', Auth::user()->id], ['status', '=', 'hold']])
                                       ->orWhere([['supplier_id','=', Auth::user()->id], ['status', '=', 'accepted']])
                                        ->first();
            */
            //dd($transaction);
            /*
            if (! is_null($transaction) && Auth::user()->role == 'Shopkeeper') {

            }
            */




        return $next($request);
    }
}
