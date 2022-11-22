<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StoreFirstPasswordUsersController extends Controller
{
    public function __invoke(Request $request)
    {

        $pass1 = $request->input('password1');
        $pass2 = $request->input('password2');

        if ($pass1 == $pass2) {
            if (strlen($pass1) < 7 || !preg_match('`[0-9]`', $pass1)
                || !preg_match('`[a-z]`',$pass1)) {

                return redirect()->route('users.first.password')->with('unfulfilledRequirements', 'La contraseña debe tener mínimo 7 caracteres, al menos una letra y al menos un número.');
            }
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($pass1);
            $user->first_login = 1;
            $user->save();

            return redirect()->route('home');

        }

        return redirect()->route('users.first.password')->with('differentPasswords', 'Las contraseñas no coinciden.');
    }
}
