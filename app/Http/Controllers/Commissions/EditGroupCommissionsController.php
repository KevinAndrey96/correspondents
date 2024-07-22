<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditGroupCommissionsController extends Controller
{
    public function __invoke($id)
    {
        $commissionsGPGeneralCommission = CommissionsGroupGeneralCommission::with('commissionGroup', 'generalCommission')
            ->where('comm_group_id', $id)->get();

        $commissionsGroup = CommissionsGroup::find($id);

        $commissions = Commission::where('user_id', Auth::user()->id)->get();

        $products = array();
        $distributorCommissions = array();


        foreach ($commissions as $commission) {
            if (isset($commission->product) && $commission->product->is_enabled == 1 && $commission->product->is_deleted == 0) {
                array_push($products, $commission->product);
                array_push( $distributorCommissions, $commission);
            }
        }

        $products = collect($products);

        $products->map(function($product) use ($commissionsGPGeneralCommission){
            $product->isUsed = 0;
            $product->shopComm = 0;
            $product->distComm = 0;

            foreach ($commissionsGPGeneralCommission as $item) {
                if ($product->id == $item->generalCommission->product_id) {
                    $product->isUsed = 1;
                    $product->shopComm = $item->generalCommission->amount_shop;
                    $product->distComm = $item->generalCommission->amount_dis;
                    break;
                }
            }

            return $product;
        });

        return view('commissions.editGroup', ['commissionsGPGeneralCommission' => $commissionsGPGeneralCommission,
        'products' => $products, 'commissionsGroup' => $commissionsGroup, 'distributorCommissions' => $distributorCommissions]);
    }
}
