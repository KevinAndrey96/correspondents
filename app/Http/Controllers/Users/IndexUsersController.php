<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexUsersController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');
        if ($role == 'Administrator') {
            $users = User::where('role', 'like', 'Administrator')->get();
            return view('users.index', compact('role', 'users'));
        }
        if ($role == 'Shopkeeper') {
            $users = User::where('role', 'like', 'Shopkeeper')->get();
            return view('users.index', compact('role', 'users'));
        }
        if ($role == 'Supplier') {
            $users = User::where('role', 'like', 'Supplier')->get();
            return view('users.index', compact('role', 'users'));
        }
        if ($role == 'Distributor') {
            $users = User::where('role', 'like', 'Distributor')->get();
            return view('users.index', compact('role', 'users'));
        }
    }
}
