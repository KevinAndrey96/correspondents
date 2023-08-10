<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Card;
use App\Models\User;
use App\Models\Brand;

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

        if ($role == 'Saldos') {
            $cards = Card::all();
            return view('users.create', compact('role', 'cards'));
        }

        if ($role == 'Advisers') {
            return view('users.create', compact('role'));
        }

        if ($role == 'Shopkeeper') {
            $advisers = User::where('role', 'Advisers')->get();

            return view('users.create', compact('role', 'advisers'));

        }


        if ($role == 'Distributor') {
            $brands = Brand::all();

            return view('users.create', compact('role', 'brands'));

        }

        return view('users.create', compact('role'));
    }
}
