<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Commission;
use App\Models\SupplierProduct;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateCommissionsController extends Controller
{
    public function create($id)
    {
        $user = User::find($id);
        $userLogged = User::find(Auth::user()->id);
        if ($userLogged->role == 'Distributor') {
            if ($userLogged->id != $user->distributor_id) {
                return redirect('/home')->with('deniedAccess', 'Acceso denegado');
            }
        }
        if ($userLogged->role == 'Administrator') {
            if ($user->role != 'Distributor' && $user->role != 'Supplier') {
                return redirect('/home')->with('deniedAccess', 'Acceso denegado');
            }
        }
        if ($userLogged->role == 'Shopkeeper') {
            return redirect('/home')->with('deniedAccess', 'Acceso denegado');
        }
        if ($userLogged->role == 'Supplier') {
            return redirect('/home')->with('deniedAccess', 'Acceso denegado');
        }

        $products = Product::all();
        foreach ($products as $product) {
            $commission = Commission::where('user_id', '=', $id)
                ->where('product_id', '=', $product->id)
                ->first();
            if (is_null($commission)) {
                $commission = new Commission();
                $commission->user_id = $id;
                $commission->product_id = $product->id;
                $commission->amount = 0;
                $commission->save();
            }
        }
        $productsExcept = Product::where('is_enabled','=','0')->pluck('id')->toArray();
        $commissions = Commission::where('user_id', '=', $id)->whereNotIn('product_id',$productsExcept)->get();
        $userProducts = SupplierProduct::where('user_id', $id)->get();

        return view('commissions.create', compact('commissions', 'user', 'userProducts'));
    }

}
