<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;

class LockPlatformMiddleware
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
        /*
        $platform = Platform::find(1);

        if (Auth::user()->role !== 'Administrator' && $platform->is_enabled == 0) {
            Auth::logout();

            return redirect('/');
        }
        */
        return $next($request);
    }
}
