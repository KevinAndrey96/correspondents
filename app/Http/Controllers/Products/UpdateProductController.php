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
            'clientName'=>'required|boolean',
            'clientDocument'=>'required|boolean',
            'email'=>'required|boolean',
            'accountType'=>'required|boolean',
            'code'=>'required|boolean',
            'extra'=>'required|boolean',
            'min_amount'=>'required',
            'max_amount'=>'required',
            'priority'=>'required',
            'num_jineteo'=>'required',
            'hours'=>'required',
            'reassignment_minutes' => 'required'
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
            'client_name'=> $request->input('clientName'),
            'client_document'=> $request->input('clientDocument'),
            'email'=> $request->input('email'),
            'account_type'=> $request->input('accountType'),
            'code'=> $request->input('code'),
            'extra'=> $request->input('extra'),
            'min_amount' => $request->input('min_amount'),
            'max_amount' => $request->input('max_amount'),
            'priority' => $request->input('priority'),
            'num_jineteo' => $request->input('num_jineteo'),
            'hours' => $request->input('hours'),
            'reassignment_minutes' => $request->input('reassignment_minutes')
        ];
        $product = Product::findOrFail($productId);
        if ($request->hasFile('image')) {
            $pathName = Sprintf('products/%s.png', $product->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
            //dd(Storage::path('products\\' .$product->id . '.png'));
            //dd(Storage::disk('public')->path('products/' .$product->id . '.png'));
            $client = new Client();
            $urlServer = getenv('URL_SERVER');
            $url = $urlServer."/upload.php";

            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace('\\', '/', Storage::disk('public')->path('products/' .$product->id . '.png')),'r'),
                        /*'contents' => fopen(
                            Storage::disk('public')
                                ->getDriver()
                                ->getAdapter()
                                ->getPathPrefix() . 'blogs/' . $blog->id . '.png', 'r'),*/
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
