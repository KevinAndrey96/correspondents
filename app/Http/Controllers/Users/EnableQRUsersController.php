<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EnableQRUsersController extends Controller
{
    public function __invoke(Request $request)
    {
       $user = User::find($request->input('id'));
       $user->qr_enabled = $request->input('enabledQR');
       $user->save();

       if ($user->role == 'Distributor' || $user->role == 'Administrator' || $user->role == 'Supplier'){

           return redirect('/users?role='.$user->role);
       }

      return redirect('/users?role=allShopkeepers');


    }
}
