<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DailyPasswordUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $pass1 = $request->input('password1');
        $pass2 = $request->input('password2');

        if ($pass1 !== $pass2) {
            return redirect()->route('users.daily.password')->with('differentPass', 'Ambas contraseñas deben ser iguales');
        }

        $user->daily_password_date = Carbon::now()->format('Y-m-d');
        $user->daily_password = Hash::make($pass1);
        $user->save();
        return redirect()->route('home');


    }
}
