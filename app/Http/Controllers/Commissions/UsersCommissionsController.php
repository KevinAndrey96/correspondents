<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersCommissionsController extends Controller
{
 public function usersCommissions(Request $request)
 {
     $userType = $request->input('id');
     $role = Auth::user()->role;
     if ($role == 'Administrator') {
        $users = User::where('role', 'like', 'Distributor')
                        ->orWhere('role', 'like', 'Supplier')->get();

        return view('commissions.users', compact('users'));

     }
     if ($role == 'Distributor') {
         $users = User::where('role', 'like', 'Shopkeeper')->get();

         return view('commissions.users', compact('users'));
     }
 }
}
