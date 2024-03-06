<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use App\Models\GeneralCommission;
use App\Models\Product;
use App\Models\SupplierProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UpdateGroupCommissionsController extends Controller
{
    public function __invoke(Request $request)
    {
        set_time_limit(0);
        //Here it validates the request
        $fields = [
            'name' => 'required|string',
            'products' => 'required',
            'amountsDis' => 'required',
            'amountsShop' => 'required',
            'commissionsGroupID' => 'required|string'
        ];

        $message = [
            'required' => ':attribute es requerido',
        ];

        $this->validate($request, $fields, $message);

        //Here mapping $amounts and $products to float array and integer array
        $products = Arr::map($request->input('products'), function ($value) {
            return intval($value);
        });

        $amountsDis = Arr::map($request->input('amountsDis'), function ($value) {
            return floatval($value);
        });

        $amountsShop = Arr::map($request->input('amountsShop'), function ($value) {
            return floatval($value);
        });

        for ($i = 0; $i < count($amountsDis); $i++) {
            $commission = Commission::where([
                ['product_id', $products[$i]],
                ['user_id', Auth::user()->id]
            ])
                ->first();

            if ($amountsDis[$i] != floatval($commission->amount)) {
                return redirect()->route('commissions.edit-group', ['id' => $request->input('commissionsGroupID')])
                    ->with('systemError', 'Hubo un error en el sistema por favor intente de nuevo');
            }
        }



        //If exists a commission amount that exceeded its correspondent product commission amount it will return to
        //create commissions group with error message
        for ($i = 0; $i < count($amountsDis); $i++) {
            $product = Product::find($products[$i]);
            if ($amountsDis[$i] > $product->product_commission || $amountsShop[$i] > $product->product_commission ||
                $amountsShop[$i] > $amountsDis[$i]) {

                return redirect()->route('commissions.edit-group')->with('notAllowedAmount', 'Monto de comisión no permitido');
            }
        }

        //Here we get commissionsGroup register by its id and assigning a new name;
        $commissionsGroup = CommissionsGroup::find(intval($request->input('commissionsGroupID')));
        $commissionsGroup->name = $request->input('name');
        $commissionsGroup->save();

        $commissionsGPGeneralCommissions = CommissionsGroupGeneralCommission::where('comm_group_id', $commissionsGroup->id)->get();

        //Delete general commissions of commissions group
        foreach ($commissionsGPGeneralCommissions as $commission) {
            $commission->delete();
        }

        //Creating registers to general_commissions and commissions_group_general_commissions tables
        for ($i = 0; $i < count($products); $i++) {
            $generalCommission = new GeneralCommission();
            $generalCommission->product_id = $products[$i];
            $generalCommission->amount_dis= $amountsDis[$i];
            $generalCommission->amount_shop = $amountsShop[$i];
            $generalCommission->save();

            $commGPGralComm = new CommissionsGroupGeneralCommission();
            $commGPGralComm->comm_group_id = $commissionsGroup->id;
            $commGPGralComm->gen_comm_id = $generalCommission->id;
            $commGPGralComm->save();
        }

        $commissionsGPGeneralCommissions = CommissionsGroupGeneralCommission::where('comm_group_id', $commissionsGroup->id)->get();

        $users = User::where('commissions_group_id', $commissionsGroup->id)->get();

        foreach ($users as $user) {
            $commissions = Commission::where('user_id', $user->id)->get();
            $userProducts = SupplierProduct::where('user_id', $user->id)->get();

            foreach ($commissions as $commission) {
                $commission->delete();
            }

            foreach ($userProducts as $userProduct) {
                $userProduct->delete();
            }

            foreach ($commissionsGPGeneralCommissions as $item) {
                $commission = new Commission();
                $commission->product_id = $item->generalCommission->product_id;
                $commission->user_id = $user->id;
                $commission->amount = $item->generalCommission->amount_dis;

                if ($user->role == 'Shopkeeper') {
                    $commission->amount = $item->generalCommission->amount_shop;
                }

                $commission->save();

                $userProduct = new SupplierProduct();
                $userProduct->user_id = $user->id;
                $userProduct->product_id = $item->generalCommission->product_id;
                $userProduct->save();
            }
        }

        return redirect()->route('commissions.groups')->with('successfulCommissionsGroupUpdate', 'Modificación de grupo de comisiones exitosa');
    }

}
