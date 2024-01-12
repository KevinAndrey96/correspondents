<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use App\Models\GeneralCommission;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class StoreGroupCommissionsController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        //Here it validates the request
        $fields = [
            'name' => 'required|string',
            'products' => 'required',
            'amounts' => 'required'
        ];

        $message = [
            'required' => ':attribute es requerido',
        ];

        $this->validate($request, $fields, $message);

        //Here mapping $amounts and $products to float array and integer array
        $products = Arr::map($request->input('products'), function ($value) {
            return intval($value);
        });

        $amounts = Arr::map($request->input('amounts'), function ($value) {
            return floatval($value);
        });

        //If exists a commission amount that exceeded its correspondent product commission amount it will return to
        //create commissions group with error message
        for ($i = 0; $i < count($amounts); $i++) {
            $product = Product::find($products[$i]);
            if ($amounts[$i] > $product->product_commission) {

                return redirect()->route('commissions.create-group')->with('notAllowedAmount', 'Monto de comisión no permitido');
            }
        }

        //Assigning name input
        $nameGroup = $request->input('name');

        //Creating new commissionGroup register
        $commissionsGroup = new CommissionsGroup();
        $commissionsGroup->name = $nameGroup;
        $commissionsGroup->save();

        //Creating registers to general_commissions and commissions_group_general_commissions tables
        for ($i = 0; $i < count($products); $i++) {
            $generalCommission = new GeneralCommission();
            $generalCommission->product_id = $products[$i];
            $generalCommission->amount = $amounts[$i];
            $generalCommission->save();

            $commGPGralComm = new CommissionsGroupGeneralCommission();
            $commGPGralComm->comm_group_id = $commissionsGroup->id;
            $commGPGralComm->gen_comm_id = $generalCommission->id;
            $commGPGralComm->save();
        }

        return redirect()->route('commissions.groups')->with('successfulGroupCommissionCreation', 'Creación de grupo de comisiones exitosa');
    }
}
