<?php

namespace PragmaRX\Google2FALaravel;

use App\Models\User;
use Closure;
use PragmaRX\Google2FALaravel\Support\Auth;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class Middleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->qr_enabled != 1) {

            return $next($request);
        }

        $authenticator = app(Authenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {

            return $next($request);
        }

        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}
