<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class UpdateProductController extends Controller
{
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
}
