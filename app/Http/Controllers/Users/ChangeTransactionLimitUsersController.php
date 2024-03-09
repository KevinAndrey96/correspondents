<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SupplierProduct;
use App\Models\User;
use App\Models\UserTransactionLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeTransactionLimitUsersController extends Controller
{
    public function __invoke($id)
    {
        $userName = User::find($id)->name;
        $userTransactionLimits = UserTransactionLimit::with('user', 'product')->where('user_id', $id)->get();
        $shopkeeperProducts = SupplierProduct::where('user_id', $id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $shopkeeperProducts)
            ->where('is_deleted', 0)
            ->where('is_enabled',1)
            ->where('giros', 0)
            ->orderBy('priority', 'asc')
            ->get();

        return view('users.createTransactionLimit', ['products' => $products, 'userID' => $id, 'userTransactionLimits' => $userTransactionLimits, 'userName' => $userName]);
    }
}
