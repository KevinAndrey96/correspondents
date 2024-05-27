<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EnableDevModeUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->developer_mode = intval($request->input('enabledDevMode'));
        $user->save();

        return back();
    }
}
