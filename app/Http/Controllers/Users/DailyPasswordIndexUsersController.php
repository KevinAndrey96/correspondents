<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyPasswordIndexUsersController extends Controller
{
    public function __invoke()
    {
        return view('users.dailyPassword');
    }
}
