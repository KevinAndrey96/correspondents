<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

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
            'productCommission'=>'required',
            'clientName'=>'required|boolean',
            'clientDocument'=>'required|boolean',
            'phoneNumber'=>'required|boolean',
            'email'=>'required|boolean',
            'accountType'=>'required|boolean',
            'accountNumber'=>'required|boolean',
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
        $product->client_document = $request->input('clientDocument');
        $product->account_type = $request->input('accountType');
        $product->account_number = $request->input('accountNumber');
        $product->email = $request->input('email');
        $product->client_name = $request->input('clientName');
        $product->phone_number = $request->input('phoneNumber');
        $product->product_commission = $request->input('productCommission');
        $product->code = $request->input('code');
        $product->extra = $request->input('extra');
        $product->save();
        if ($request->hasFile('image')) {
            $pathName = Sprintf('products/%s.png', $product->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
            $client = new Client();
            $url = "https://corresponsales.asparecargas.net/upload.php";
            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace('\\', '/', Storage::path('public\products\\' .$product->id . '.png')),'r'),
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'products'
                    ]
                ]
            ]);
            $product->product_logo = '/storage/products/' . $product->id . '.png';
            $product->save();
            unlink(str_replace('\\', '/', storage_path('app/public/products/'.$product->id.'.png')));
        }

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
            'productCommission'=>'required',
            'isEnabled'=>'required|boolean',
            'clientName'=>'required|boolean',
            'clientDocument'=>'required|boolean',
            'phoneNumber'=>'required|boolean',
            'email'=>'required|boolean',
            'accountType'=>'required|boolean',
            'accountNumber'=>'required|boolean',
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
            'product_commission'=> $request->input('productCommission'),
            'is_enabled'=> $request->input('isEnabled'),
            'client_name'=> $request->input('clientName'),
            'client_document'=> $request->input('clientDocument'),
            'phone_number'=> $request->input('phoneNumber'),
            'email'=> $request->input('email'),
            'account_type'=> $request->input('accountType'),
            'account_number'=> $request->input('accountNumber'),
            'code'=> $request->input('code'),
            'extra'=> $request->input('extra'),
        ];
        $product = Product::findOrFail($productId);
        if ($request->hasFile('image')) {
            $pathName = Sprintf('products/%s.png', $product->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
            //dd(Storage::path('products\\' .$product->id . '.png'));
            //dd(Storage::disk('public')->path('products/' .$product->id . '.png'));
            $client = new Client();
            $url = "https://corresponsales.asparecargas.net/upload.php";
            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace('\\', '/', Storage::disk('public')->path('products/' .$product->id . '.png')),'r'),
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'products'
                    ]
                ]
            ]);
            $product->product_logo = '/storage/products/' . $product->id . '.png';
            $product->save();
            unlink(str_replace('\\', '/', storage_path('app/public/products/'.$product->id.'.png')));
        }
        Product::where('id', '=', $productId)->update($productData);
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
