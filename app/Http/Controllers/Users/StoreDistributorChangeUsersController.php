<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use App\Models\SupplierProduct;
use App\Models\User;
use Illuminate\Http\Request;

class StoreDistributorChangeUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $distributorID = intval($request->input('distributorID'));
        $shopkeeperID = intval($request->input('shopkeeperID'));
        $distributor = User::find($distributorID);

        $shopkeeper = User::find($shopkeeperID);
        $shopkeeper->distributor_id = $distributorID;
        $shopkeeper->save();

        if (isset($distributor->commissions_group_id)) {
            $commissionsGroup = CommissionsGroup::find($distributor->commissions_group_id);
            $commissionsGroupGeneralCommissions = CommissionsGroupGeneralCommission::with('generalCommission', 'commissionGroup')->
            where('comm_group_id', $commissionsGroup->id)->get();

            $shopkeeper->commissions_group_id = $distributor->commissions_group_id;
            $shopkeeperProducts = SupplierProduct::where('user_id', $shopkeeper->id)->get();
            $distributorProducts = SupplierProduct::where('user_id', $distributor->id)->pluck('product_id');
            $shopkeeperCommissions = Commission::where('user_id', $shopkeeper->id)->get();

            if ($shopkeeperProducts->count() > 0) {
                foreach ($shopkeeperProducts as $shopkeeperProduct) {
                    $shopkeeperProduct->delete();
                }
            }

            if ($shopkeeperCommissions->count() > 0) {
                foreach ($shopkeeperCommissions as $commission) {
                    $commission->delete();
                }
            }

            foreach ($distributorProducts as $productID) {
                $shopkeeperProduct = new SupplierProduct();
                $shopkeeperProduct->product_id = $productID;
                $shopkeeperProduct->user_id = $shopkeeper->id;
                $shopkeeperProduct->save();

                $commission = new Commission();
                $commission->user_id = $shopkeeper->id;
                $commission->product_id = $productID;
                $commission->amount = 0;
                $commission->save();
            }
        }

        return redirect('/users?role=allShopkeepers');
    }
}
