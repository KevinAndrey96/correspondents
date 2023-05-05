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
    public function __invoke($id, $isInspector)
    {
        $user = User::find($id);

        if ($isInspector == 1) {
            $user = User::find($id);
            $user->qr = 0;
            $user->backup_google2fa_secret = $user->google2fa_secret;
            $user->save();

            Auth::user()->impersonate($user);

            return redirect()->route('complete.registration');
        }

        Auth::user()->leaveImpersonation();

        return redirect('/users?role=allShopkeepers');
    }
}
