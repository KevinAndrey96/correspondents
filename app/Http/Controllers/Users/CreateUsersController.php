<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateUsersController extends Controller
{
    public function create(Request $request)
    {
        $role = $request->input('role');
        return view('users.create', compact('role'));
    }
}
