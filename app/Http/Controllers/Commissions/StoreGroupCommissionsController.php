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
use Illuminate\Support\Facades\Auth;
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
            'amountsDis' => 'required',
            'amountsShop' => 'required'
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
                return redirect()->route('commissions.create-group')->with('systemError', 'Hubo un error en el sistema
                por favor intente de nuevo');
            }
        }

        //If exists a commission amount that exceeded its correspondent product commission amount it will return to
        //create commissions group with error message
        for ($i = 0; $i < count($amountsDis); $i++) {
            $product = Product::find($products[$i]);
            if ($amountsDis[$i] > $product->product_commission || $amountsShop[$i] > $product->product_commission ||
                $amountsShop[$i] > $amountsDis[$i]) {

                return redirect()->route('commissions.create-group')->with('notAllowedAmount', 'Monto de comisión no permitido');
            }
        }

        //Assigning name input
        $nameGroup = $request->input('name');

        //Creating new commissionsGroup register
        $commissionsGroup = new CommissionsGroup();
        $commissionsGroup->name = $nameGroup;
        $commissionsGroup->user_id = Auth::user()->id;
        $commissionsGroup->save();

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

        return redirect()->route('commissions.groups')->with('successfulGroupCommissionCreation', 'Creación de grupo de comisiones exitosa');
    }
}
