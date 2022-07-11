<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordUsersController extends Controller
{
    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $oldPass = $request->input('oldPass');
        $oldPass2 = Auth::user()->password;
        if (Hash::check($oldPass, $oldPass2)) {
            if ($request->input('newPass1') == $request->input('newPass2')) {
                if (strlen($request->input('newPass1')) < 7 || !preg_match('`[0-9]`',$request->input('newPass1'))
                || !preg_match('`[a-z]`',$request->input('newPass1')) ) {

                    return back()->with('unfulfilledRequirements', 'La contraseña debe tener mínimo 7 caracteres, al menos una letra y al menos un número.');
                }
                $user->password = Hash::make($request->input('newPass1'));

                /**
                 * We reset the 2FA code to set a new in the login
                 */
                $user->google2fa_secret = RegisterController::GENERIC_2FA_SECRET;
                $user->save();

                return back()->with('messageSuccess', 'Contraseña modificada con éxito');
            }
        }

        return back()->with('failChange','No se pudo cambiar la contraseña');
    }
}
