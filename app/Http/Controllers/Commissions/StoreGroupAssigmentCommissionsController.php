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

        $distributor = User::find(intval($request->input('userID')));
        $shopkeepers = User::where('distributor_id', $distributor->id)->get();
        $distributorCommissions = Commission::where('user_id', $distributor->id)->get();
        $commissionsGroup = CommissionsGroup::find(intval($request->input('commissionsGroupID')));
        $commissionsGroupGeneralCommissions = CommissionsGroupGeneralCommission::with('generalCommission', 'commissionGroup')->
        where('comm_group_id', $commissionsGroup->id)->get();

        $distributorProducts = SupplierProduct::where('user_id', $distributor->id)->get();

        //Delete on supplier_products table where user_id be equal to distributor id
        foreach ($distributorProducts as $distributorProduct) {
            $distributorProduct->delete();
        }

        //Delete distributor commissions
        foreach ($distributorCommissions as $commission) {
            $commission->delete();
        }

        //Assigning commissions group id to distributor
        $distributor->commissions_group_id = $commissionsGroup->id;
        $distributor->save();

        //Delete shopkeepers commissions, delete on supplier_products table where user_id be equal to shopkeeper id
        //and assigning commissions group id to shopkeepers
        foreach ($shopkeepers as $shopkeeper) {
            $shopkeeper->commissions_group_id = $commissionsGroup->id;
            $shopkeeper->save();
            $shopkeeperCommissions = Commission::where('user_id', $shopkeeper->id)->get();
            $shopkeeperProducts = SupplierProduct::where('user_id', $shopkeeper->id)->get();

            foreach ($shopkeeperProducts as $shopkeeperProduct) {
                $shopkeeperProduct->delete();
            }

            foreach ($shopkeeperCommissions as $commission) {
                $commission->delete();
            }
        }


        //Assign commissions and create new register to supplier_products to distributor and shopkeepers
        foreach ($commissionsGroupGeneralCommissions as $item) {
            $distributorCommission = new Commission();
            $distributorCommission->amount = $item->generalCommission->amount_dis;
            $distributorCommission->product_id = $item->generalCommission->product_id;
            $distributorCommission->user_id = $distributor->id;
            $distributorCommission->save();

            $distributorProduct = new SupplierProduct();
            $distributorProduct->user_id = $distributor->id;
            $distributorProduct->product_id = $item->generalCommission->product_id;
            $distributorProduct->save();

            foreach ($shopkeepers as $shopkeeper) {
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
        }

        return redirect('/users?role=Distributor');
    }
}
