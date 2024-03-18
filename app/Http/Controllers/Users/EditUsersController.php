<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBank;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\ShopkeeperAdviser;
use Spatie\Permission\Models\Role;

class EditUsersController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where([
            ['name', '!=', 'Administrator'],
            ['name', '!=', 'Shopkeeper'],
            ['name', '!=', 'Supplier'],
            ['name', '!=', 'Distributor'],
            ['name', '!=', 'Saldos'],
        ])->get();

        $roleID = $user->roles[0]->id;
        $cards = Card::all();

        if ($user->role == 'Shopkeeper') {
            $shopkeeperAdviser = ShopkeeperAdviser::where('shopkeeper_id', $user->id)->first();
            $advisers = User::where('role', 'Advisers')->get();

            return view('users.edit', compact('user', 'cards', 'shopkeeperAdviser', 'advisers', 'roleID', 'roles'));
        }

        if ($user->role == 'Saldos') {
            $userBanks = UserBank::where('user_id', $id)->get();

            return view('users.edit', compact('user', 'cards', 'userBanks', 'roleID', 'roles'));

        }

        if ($user->role == 'Distributor') {
            $brands = Brand::all();

            return view('users.edit', compact('user', 'cards', 'brands', 'roleID', 'roles'));
        }

        return view('users.edit', compact('user', 'cards', 'roleID', 'roles'));
    }
}
