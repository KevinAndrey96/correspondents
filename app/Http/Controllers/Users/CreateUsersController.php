<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateUsersController extends Controller
{
    public function create(Request $request)
    {
        $role = $request->input('role');
        if (Auth::user()->role == 'Distributor' && $role == 'Supplier' || Auth::user()->role == 'Administrator' && $role == 'Shopkeeper'
            || Auth::user()->role == 'Distributor' && $role == 'Distributor' || Auth::user()->role == 'Distributor' && $role == 'Administrator'
            || Auth::user()->role == 'Supplier' || Auth::user()->role == 'Shopkeeper') {

            return redirect('/home')->with('deniedAccess', 'Acceso denegado');
        }

        return view('users.create', compact('role'));
    }
}
