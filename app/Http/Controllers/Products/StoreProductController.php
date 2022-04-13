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
}
