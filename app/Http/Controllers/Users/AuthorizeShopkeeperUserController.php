<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthorizeShopkeeperUserController extends Controller
{

    public function __invoke(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->is_authorized = $request->input('authorized');
        if ($user->is_authorized == 0 && $user->role == 'Supplier') {
            $user->is_online = 0;
        }
        $user->save();

        return back();
    }

}
