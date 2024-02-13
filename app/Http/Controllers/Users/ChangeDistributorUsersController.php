<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChangeDistributorUsersController extends Controller
{
    public function __invoke($shopkeeperID)
    {
        $distributors = User::where([
            ['role', 'Distributor'],
            ['is_enabled', 1]
        ])->get(['id', 'name']);

        $shopkeeper = User::find(intval($shopkeeperID));


        return view('users.changeDistributor', ['distributors' => $distributors, 'shopkeeper' => $shopkeeper]);
    }
}
