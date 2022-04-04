<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateUsersController extends Controller
{
    public function update(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->commission = $request->input('commission');
        $user->document_type = $request->input('document_type');
        $user->document = $request->input('document');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        if (isset($request->transaction_limit)) {
            $user->transaction_limit = $request->input('transaction_limit');
        }
        if (isset($request->priority)) {
            $user->priority = $request->input('priority');
        }
        if (isset($request->password)) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        
        return redirect('/users?role='.$user->role);
    }
}
