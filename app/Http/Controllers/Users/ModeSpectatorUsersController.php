<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PragmaRX\Google2FA\Google2FA;

class ModeSpectatorUsersController extends Controller
{
    public function __invoke($id, $isInsSpector)
    {
        //session(['enabled2fa', false]);

        if ($isInsSpector == 1) {
            $user = User::find($id);
            //$google2fa = app(Google2FA::class);
            //$google2fa->temporaryDisableTwoFactorAuth($user);

            Auth::user()->impersonate($user);

            return redirect()->route('home');
        }

        Auth::user()->leaveImpersonation();
        return redirect()->route('home');



    }
}
