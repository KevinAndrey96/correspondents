<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierProduct;

class StoreAssignmentsProductsController extends Controller
{
    public function __invoke(Request $request)
    {
        $userID = intVal($request->input('user_id'));
        $supplierProducts = SupplierProduct::where('user_id', $userID)->get();
        $products = $request->input('products');

        if (is_null($products)) {

            return back()->with('noChecked', 'Debe seleccionar al menos un producto');
        }

        if ($supplierProducts->count() > 0) {
            foreach ($supplierProducts as $value) {
                SupplierProduct::destroy($value->id);
            }
            for ($i = 0; $i < count($products); $i++) {
                $supplierProduct = new SupplierProduct();
                $supplierProduct->user_id = $userID;
                $supplierProduct->product_id = $products[$i];
                $supplierProduct->save();
            }

            return redirect('/users?role=Supplier')->with('successfulAssignment', 'Asignación de productos satisfactoria');
        }

        for ($i = 0; $i < count($products); $i++) {
            $supplierProduct = new SupplierProduct();
            $supplierProduct->user_id = $userID;
            $supplierProduct->product_id = $products[$i];
            $supplierProduct->save();
        }

        return redirect('/users?role=Supplier')->with('successfulAssignment', 'Asignación de productos satisfactoria');
    }
}
