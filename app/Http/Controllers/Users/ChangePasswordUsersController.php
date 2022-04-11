<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordUsersController extends Controller
{
    public function changePassword()
    {
        return view('users.changePassword');
    }
}
