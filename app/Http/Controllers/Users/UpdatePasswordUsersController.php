<?php

namespace App\Http\Controllers\Users;

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
        $id = $user->id;
        $oldPass = $request->input('oldPass');
        $oldPass2 = Auth::user()->password;
        if (Hash::check($oldPass, $oldPass2)) {
            if ($request->input('newPass1') == $request->input('newPass2')) {
                $user->password = Hash::make($request->input('newPass1'));
                $user->save();

                return back()->with('messageSuccess', 'Contraseña modificada con éxito');
            }
        }

        return back()->with('failChange','No se pudo cambiar la contraseña');
    }
}
