<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreUsersController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->phone =  $request->input('phone');
        $user->document_type = $request->input('document_type');
        $user->document = $request->input('document');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->commission = $request->input('commission');
        $user->balance = $request->input('balance');
        $user->is_enabled = 1;
        if ($request->input('role') == 'Supplier') {
            $user->priority = $request->input('priority');
            $user->max_queue = $request->input('max_queue');
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        if ($request->input('role') == 'Administrator') {
            $user->assignRole('Administrator');
        }
        if ($request->input('role') == 'Shopkeeper') {
            $user->assignRole('Shopkeeper');
        }
        if ($request->input('role') == 'Distributor') {
            $user->assignRole('Distributor');
        }
        if ($request->input('role') == 'Supplier') {
            $user->assignRole('Supplier');
        }

        return redirect('/users?role='.$user->role);
    }
}
