<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsData['products'] = Product::all();
        return view('product.index',$productsData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [
            'productName'=>'required|string',
            'productType'=>'required|string',
            'productDescription'=>'required|string',
            'nameField'=>'required|boolean',
            'accountType'=>'required|boolean',
            'accountNumber'=>'required|boolean',
            'email'=>'required|boolean',
            'clientName'=>'required|boolean',
            'phoneNumber'=>'required|boolean',
            'code'=>'required|boolean',
            'extra'=>'required|boolean',
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $product = new Product();
        $product->product_name = $request->input('productName');
        $product->product_type = $request->input('productType');
        $product->product_description = $request->input('productDescription');
        $product->client_document = $request->input('nameField');
        $product->account_type = $request->input('accountType');
        $product->account_number = $request->input('accountNumber');
        $product->email = $request->input('email');
        $product->client_name = $request->input('clientName');
        $product->phone_number = $request->input('phoneNumber');
        $product->code = $request->input('code');
        $product->extra = $request->input('extra');

        $product->save();

        return redirect('products');
        //return response()->json(request()->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId)
    {
        $fields = [
            'productName'=>'required|string',
            'productType'=>'required|string',
            'productDescription'=>'required|string',
            'isEnabled'=>'required|boolean',
            'nameField'=>'required|boolean',
            'accountType'=>'required|boolean',
            'accountNumber'=>'required|boolean',
            'email'=>'required|boolean',
            'clientName'=>'required|boolean',
            'phoneNumber'=>'required|boolean',
            'code'=>'required|boolean',
            'extra'=>'required|boolean',
        ];
        $message= [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $productData = [
            'product_name'=> $request->input('productName'),
            'product_type'=> $request->input('productType'),
            'product_description'=> $request->input('productDescription'),
            'is_enabled'=> $request->input('isEnabled'),
            'name_field'=> $request->input('nameField'),
            'account_type'=> $request->input('accountType'),
            'account_number'=> $request->input('accountNumber'),
            'email'=> $request->input('email'),
            'client_name'=> $request->input('clientName'),
            'phone_number'=> $request->input('phoneNumber'),
            'code'=> $request->input('code'),
            'extra'=> $request->input('extra'),
        ];
        $product = Product::findOrFail($productId);
        product::where('id', '=', $productId)->update($productData);
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        Product::destroy($productId);
        return redirect('products');
    }
}
