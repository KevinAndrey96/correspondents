<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use App\Models\SupplierProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreGroupAssigmentCommissionsController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        set_time_limit(0);

        //Validate fields
        $fields = [
            'commissionsGroupID' => 'required|string',
            'userID' => 'required|string'
        ];

        $message = [
            'required' => 'El :attribute es requerido'
        ];

        $this->validate($request, $fields, $message);

        $shopkeeper = User::find(intval($request->input('userID')));
        $shopkeeperCommissions = Commission::where('user_id', $shopkeeper->id)->get();
        $commissionsGroup = CommissionsGroup::find(intval($request->input('commissionsGroupID')));
        $commissionsGroupGeneralCommissions = CommissionsGroupGeneralCommission::with('generalCommission', 'commissionGroup')->
        where('comm_group_id', $commissionsGroup->id)->get();
        $shopkeeperProducts = SupplierProduct::where('user_id', $shopkeeper->id)->get();

        foreach ($shopkeeperProducts as $shopkeeperProduct) {
            $shopkeeperProduct->delete();
        }

        foreach ($shopkeeperCommissions as $commission) {
            $commission->delete();
        }

        $shopkeeper->commissions_group_id = $commissionsGroup->id;
        $shopkeeper->save();

        foreach ($commissionsGroupGeneralCommissions as $item) {
            $shopkeeperCommission = new Commission();
            $shopkeeperCommission->amount = $item->generalCommission->amount_shop;
            $shopkeeperCommission->product_id = $item->generalCommission->product_id;
            $shopkeeperCommission->user_id = $shopkeeper->id;
            $shopkeeperCommission->save();

            $shopkeeperProduct = new SupplierProduct();
            $shopkeeperProduct->user_id = $shopkeeper->id;
            $shopkeeperProduct->product_id = $item->generalCommission->product_id;
            $shopkeeperProduct->save();
        }

        return redirect('/users?role=Shopkeeper');
    }
}
