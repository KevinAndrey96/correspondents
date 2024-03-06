<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ShopkeeperAdviser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexUsersController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');
        $urlServer = getenv('URL_SERVER');
        $balanceModificationData = null;

        if (session()->has('balanceModificationData')) {
            $balanceModificationData = session('balanceModificationData');

            session()->forget('balanceModificationData');
        }

        if ($role === 'Advisers') {
            $users = User::where('role', 'Advisers')->get();
            return view('users.index', compact('role', 'users', 'urlServer'));
        }


        if ($role === 'Administrator') {
            $users = User::where('role', 'like', 'Administrator')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'urlServer', 'balanceModificationData'));
        }
        if ($role === 'Shopkeeper') {
            $shopkeeperAdvisers = ShopkeeperAdviser::all();
            $users = User::where('role', 'like', 'Shopkeeper')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->where('distributor_id', '=', Auth::user()->id)->get();
            return view('users.index', compact('role', 'users', 'urlServer', 'shopkeeperAdvisers', 'balanceModificationData'));
        }
        if ($role === 'allShopkeepers') {
            $shopkeeperAdvisers = ShopkeeperAdviser::all();
            $users = User::where('role', 'like', 'Shopkeeper')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'urlServer', 'shopkeeperAdvisers', 'balanceModificationData'));
        }
        if ($role === 'Supplier') {
            $users = User::where('role', 'like', 'Supplier')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'urlServer', 'balanceModificationData'));
        }
        if ($role === 'Distributor') {
            $users = User::where('role', 'like', 'Distributor')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'urlServer', 'balanceModificationData'));
        }

        if ($role === 'Saldos') {
            $users = User::where('role', 'like', 'Saldos')
                ->where('is_enabled', '=', User::STATUS_ENABLED)
                ->get();
            return view('users.index', compact('role', 'users', 'urlServer', 'balanceModificationData'));
        }
    }
}
