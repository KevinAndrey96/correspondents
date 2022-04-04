<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditUsersController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
}
