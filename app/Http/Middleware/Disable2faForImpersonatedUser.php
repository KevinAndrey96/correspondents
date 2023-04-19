<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Disable2faForImpersonatedUser
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
            $request->route()->forgetParameter('2fa');
        }

        return $next($request);
    }
}
