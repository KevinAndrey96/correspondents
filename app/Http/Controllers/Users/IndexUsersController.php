<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexUsersController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');
        $countryName = getenv('COUNTRY_NAME');

        if ($role === 'Administrator') {
            $users = User::where('role', 'like', 'Administrator')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'countryName'));
        }
        if ($role === 'Shopkeeper') {
            $users = User::where('role', 'like', 'Shopkeeper')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->where('distributor_id', '=', Auth::user()->id)->get();
            return view('users.index', compact('role', 'users', 'countryName'));
        }
        if ($role === 'allShopkeepers') {
            $users = User::where('role', 'like', 'Shopkeeper')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'countryName'));
        }
        if ($role === 'Supplier') {
            $users = User::where('role', 'like', 'Supplier')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'countryName'));
        }
        if ($role === 'Distributor') {
            $users = User::where('role', 'like', 'Distributor')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'countryName'));
        }

        if ($role === 'Saldos') {
            $users = User::where('role', 'like', 'Saldos')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'countryName'));
        }
    }
}
