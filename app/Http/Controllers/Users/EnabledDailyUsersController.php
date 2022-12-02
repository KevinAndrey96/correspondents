<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EnabledDailyUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->enabled_daily = $request->input('enabled_daily');
        $user->save();

        return back();
    }
}
