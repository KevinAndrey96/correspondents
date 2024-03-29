<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\SupplierProduct;
use App\Models\User;

class StoreAssignmentsProductsController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $userID = intVal($user->id);
        $userRole = $user->role;
        $supplierProducts = SupplierProduct::where('user_id', $userID)->get();
        $products = $request->input('products');

        if (is_null($products)) {

            return back()->with('noChecked', 'Debe seleccionar al menos un producto');
        }

        if ($supplierProducts->count() > 0) {
            if ($userRole == 'Distributor') {
                $assignedProducts = SupplierProduct::where('user_id', $user->id)->get();
                $distributorCommissions = Commission::where('user_id', $user->id)->get();
                $newProducts = array();
                foreach ($products as $product) {
                    $matchedProductID = 0;
                    foreach ($assignedProducts as $assignedProduct) {
                        if ($assignedProduct->product_id == intval($product)) {
                            $matchedProductID++;
                        }
                    }

                    if (! $matchedProductID) {
                        array_push($newProducts, $product);
                    }
                }
            }

            foreach ($supplierProducts as $value) {
                SupplierProduct::destroy($value->id);
            }

            $userCommissions = Commission::where('user_id', $user->id)
                ->whereNotIn('product_id', $products)->get();

            foreach ($userCommissions as $commission) {
                $commission->delete();
            }

            for ($i = 0; $i < count($products); $i++) {

                $supplierProduct = new SupplierProduct();
                $supplierProduct->user_id = $userID;
                $supplierProduct->product_id = $products[$i];
                $supplierProduct->save();
            }

            if ($userRole == 'Distributor') {
                $shopkeepers = User::where('distributor_id', $user->id)->get();

                foreach ($shopkeepers as $shopkeeper) {
                    $shopkeeperProducts = SupplierProduct::where('user_id', $shopkeeper->id)->get();

                    $shopkeeperCommissions = Commission::where('user_id', $shopkeeper->id)
                        ->whereNotIn('product_id', $products)->get();

                    foreach ($shopkeeperCommissions as $commission) {
                        $commission->delete();
                    }

                    if ($shopkeeperProducts->count() == 0) {
                        for ($i = 0; $i < count($products); $i++) {
                            $supplierProduct = new SupplierProduct();
                            $supplierProduct->user_id = $shopkeeper->id;
                            $supplierProduct->product_id = $products[$i];
                            $supplierProduct->save();
                        }
                    }

                    if ($shopkeeperProducts->count() > 0) {
                        foreach ($shopkeeperProducts as $shopkeeperProduct) {
                                $key = array_search($shopkeeperProduct->product_id, $products);

                                if (! $key) {
                                    $shopkeeperProduct->delete();
                                }
                        }

                        for ($i = 0; $i < count($newProducts); $i++) {
                            $supplierProduct = new SupplierProduct();
                            $supplierProduct->user_id = $shopkeeper->id;
                            $supplierProduct->product_id = $newProducts[$i];
                            $supplierProduct->save();
                        }
                    }
                }
            }

            return redirect('/users?role='.$userRole)->with('successfulAssignment', 'Asignación de productos satisfactoria');
        }

        for ($i = 0; $i < count($products); $i++) {
            $supplierProduct = new SupplierProduct();
            $supplierProduct->user_id = $userID;
            $supplierProduct->product_id = $products[$i];
            $supplierProduct->save();
        }

        if ($userRole == 'Distributor') {
            $shopkeepers = User::where('distributor_id', $user->id)->get();

            foreach ($shopkeepers as $shopkeeper) {
                for ($i = 0; $i < count($products); $i++) {
                    $supplierProduct = new SupplierProduct();
                    $supplierProduct->user_id = $shopkeeper->id;
                    $supplierProduct->product_id = $products[$i];
                    $supplierProduct->save();
                }
            }
        }

        return redirect('/users?role='.$userRole)->with('successfulAssignment', 'Asignación de productos satisfactoria');
    }
}
