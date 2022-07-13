<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUsersController extends Controller
{
    public function update(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->document_type = $request->input('document_type');
        $user->document = $request->input('document');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        if (isset($request->max_queue)) {
            $user->max_queue = $request->input('max_queue');
        }
        if (isset($request->priority)) {
            $user->priority = $request->input('priority');
        }
        if (isset($request->password)) {
            if (strlen($request->password) < 7 || !preg_match('`[0-9]`',$request->password)
                || !preg_match('`[a-z]`', $request->password) ) {

                return back()->with('unfulfilledRequirements', 'La contraseña debe tener mínimo 7 caracteres, al menos una letra y al menos un número.');
            }
            $user->password = Hash::make($request->input('password'));
            /**
             * We reset the 2FA code to set a new in the login
             */
            $user->google2fa_secret = "eyJpdiI6InN3eWhrU3o4TnhFblcvOEpPUkJ5ZUE9PSIsInZhbHVlIjoidlRwVi9nZXFlSzRSRFRJekh6RTJYclJHOEE0OHc1N3AzRmRPb2dLUFdUUT0iLCJtYWMiOiJmYzY0NTQ2OTE5OWU1NjhiNGFiYWZkM2EwNzFkNTMyMTgzMTljMGI5ZDExOWEzMmRhOGE0MmVkZmE1ZGRmZmUzIiwidGFnIjoiIn0";
        }
        $user->save();
        dd($user);
        $user->google2fa_secret = str_replace('=', '', $user->google2fa_secret);
        $user->save();
        if (Auth::user()->role == 'Administrator' && $user->role == 'Shopkeeper') {
            return redirect('/users?role=allShopkeepers');
        }

        return redirect('/users?role='.$user->role);
    }
}
