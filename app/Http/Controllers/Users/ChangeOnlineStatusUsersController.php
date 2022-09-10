<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChangeOnlineStatusUsersController extends Controller
{
    public function changeOnlineStatus(Request $request)
    {
        if (Auth::user()->role == 'Supplier') {
            $user = User::find($request->input('id'));
            $user->is_online = $request->input('status');
            if ($user->is_online == 1) {
                $user->is_online = 0;
                $user->save();
                return redirect()->back();
            }
            $user->is_online = 1;
            $user->save();
            return redirect()->back();
        }
    }
}
