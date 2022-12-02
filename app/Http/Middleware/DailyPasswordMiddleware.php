<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DailyPasswordMiddleware
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
        date_default_timezone_set('America/Bogota');
        $user = User::find(Auth::user()->id);
        if ($user->role == 'Shopkeeper' && $user->enabled_daily == 1) {
            if (! is_null($user->daily_password_date)) {
                $currentDate = strtotime(Carbon::now()->format('Y-m-d'));
                $dailyDate = strtotime(Carbon::parse($user->daily_password_date)->format('Y-m-d'));
                if ($currentDate !== $dailyDate) {
                    return redirect()->route('users.daily.password.index');
                }
            } else {
                return redirect()->route('users.daily.password.index');
            }
        }
        return $next($request);
    }
}
