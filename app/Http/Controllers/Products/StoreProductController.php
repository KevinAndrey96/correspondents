<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class StoreProductController extends Controller
{
    public function store(Request $request)
    {

        $fields = [
            'productName'=>'required|string',
            'productType'=>'required|string',
            'productDescription'=>'required|string',
            'productCommission'=>'required',
            'clientName'=>'required|boolean',
            'clientDocument'=>'required|boolean',
            'email'=>'required|boolean',
            'accountType'=>'required|boolean',
            'code'=>'required|boolean',
            'extra'=>'required|boolean',
            'image'=>'required',
            'min_amount'=>'required',
            'max_amount'=>'required',
            'priority'=>'required',
            'num_jineteo'=>'required',
            'hours'=>'required',
            'reassignment_minutes' => 'required'

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
        $product->email = $request->input('email');
        $product->client_name = $request->input('clientName');
        $product->product_commission = $request->input('productCommission');
        $product->code = $request->input('code');
        $product->extra = $request->input('extra');
        $product->min_amount = $request->input('min_amount');
        $product->max_amount = $request->input('max_amount');
        $product->priority = $request->input('priority');
        $product->num_jineteo = $request->input('num_jineteo');
        $product->hours = $request->input('hours');
        $product->reassignment_minutes = $request->input('reassignment_minutes');
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
}
