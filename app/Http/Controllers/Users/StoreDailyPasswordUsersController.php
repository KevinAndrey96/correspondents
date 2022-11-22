<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StoreDailyPasswordUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $dailyPass1 = $request->input('password');
        $dailyPass2 = Auth::user()->daily_password;

        if (Hash::check($dailyPass1, $dailyPass2)) {
            $user = User::find(Auth::user()->id);
            $user->daily_verified = 1;
            $user->save();

            return redirect('/transactions/create');
        }

        return redirect()->route('users.require.daily.password')->with('passFail', 'La contraseña no coincide, por favor inténtelo otra vez.');


    }
}
