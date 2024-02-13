<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use App\Models\Product;
use Illuminate\Http\Request;

class EditGroupCommissionsController extends Controller
{
    public function __invoke($id)
    {
        $commissionsGPGeneralCommission = CommissionsGroupGeneralCommission::with('commissionGroup', 'generalCommission')->where('comm_group_id', $id)->get();
        $commissionsGroup = CommissionsGroup::find($id);

        $products = Product::where([
            ['is_enabled', 1],
            ['is_deleted', 0]
        ])->get();

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
        'products' => $products, 'commissionsGroup' => $commissionsGroup]);
    }
}
