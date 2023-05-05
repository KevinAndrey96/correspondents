<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductField;

class StoreFieldsProductsController extends Controller
{
    public function __invoke(Request $request)
    {
        $productFields = ProductField::first();
        $productFields->product_name = $request->input('product_name');
        $productFields->product_type = $request->input('product_type');
        $productFields->product_commission = $request->input('product_commission');
        $productFields->com_dis = $request->input('com_dis');
        $productFields->com_shp = $request->input('com_shp');
        $productFields->com_sup = $request->input('com_sup');
        $productFields->fixed_commission = $request->input('fixed_commission');
        $productFields->min_amount = $request->input('min_amount');
        $productFields->max_amount = $request->input('max_amount');
        $productFields->priority = $request->input('priority');
        $productFields->num_jineteo = $request->input('num_jineteo');
        $productFields->hours = $request->input('hours');
        $productFields->reassignment_minutes = $request->input('reassignment_minutes');
        $productFields->client_document = $request->input('client_document');
        $productFields->account_type = $request->input('account_type');
        $productFields->email = $request->input('email');
        $productFields->extra = $request->input('extra');
        $productFields->code = $request->input('code');
        $productFields->product_logo = $request->input('product_logo');
        $productFields->product_description = $request->input('product_description');
        $productFields->save();

        return redirect()->route('product.fields')->with('modifiedFields', 'Campos modificados');
    }
}
