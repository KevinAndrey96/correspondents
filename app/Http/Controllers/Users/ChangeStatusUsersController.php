<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChangeStatusUsersController extends Controller
{
    public function changeStatus(Request $request)
    {
        //return $request;
        $user = User::find($request->input('id'));
        $user->is_enabled = $request->input('status');
        $user->save();
        return back();
    }
}
