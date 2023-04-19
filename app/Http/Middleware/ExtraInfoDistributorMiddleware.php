<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ExtraInfoDistributorMiddleware
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

        $user = User::find(Auth::user()->id);


        if ($user->role == 'Shopkeeper' && $user->extrainfo == 0) {

            $rutName = getenv('RUT_NAME');

            return redirect()->route('distributor.extrainfo')->with('rutName', $rutName);
        }

        return $next($request);
    }
}
