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
            'min_amount'=>'required',
            'max_amount'=>'required',
            'priority'=>'required',
            'num_jineteo'=>'required',
            'hours'=>'required',
            'reassignment_minutes' => 'required',
            'fixed_commission' => 'required',
            'defaultFieldsRadio' => 'required'
        ];

        $defaultFields = [
            'clientDocument'=>'required|boolean',
            'accountType'=>'required|boolean',
            'email'=>'required|boolean',
            'extra'=>'required|boolean',
            'code'=>'required|boolean',
            'clientName'=>'required|boolean',
        ];

        if (! $request->defaultFieldsRadio) {
            $defaultFields = [
                'fieldNames' => 'required'
            ];
        }

        $fields = array_merge($fields, $defaultFields);

        $message= [
            'required' => ':attribute es requerido',
            'fieldNames.required' => 'Los nombres de los campos son requeridos',
            'defaultFieldsRadio.required' => 'Por favor seleccione el tipo de campo para la transacción'
        ];

        $this->validate($request, $fields, $message);

        $product = Product::find($productId);

        $product->product_name = $request->input('productName');
        $product->product_type = $request->input('productType');
        $product->product_description = $request->input('productDescription');
        $product->are_default_fields = 1;

        if (intval($request->defaultFieldsRadio)) {
            $product->client_document = $request->input('clientDocument');
            $product->account_type = $request->input('accountType');
            $product->email = $request->input('email');
            $product->extra = $request->input('extra');
            $product->code = $request->input('code');
            $product->client_name = $request->input('clientName');
        }

        if (! intval($request->defaultFieldsRadio)) {
            $product->are_default_fields = 0;
            $product->client_document = 0;
            $product->account_type = 0;
            $product->email = 0;

            if (intval($request->accountType)) {
                $product->account_type = 1;
            }

            if (intval($request->email)) {
                $product->email = 1;
            }

            $product->extra = 0;
            $product->code = 0;
            $product->client_name = 0;
            $product->field_names = implode(',', $request->fieldNames);
        }

        $product->product_commission = $request->input('productCommission');
        $product->min_amount = $request->input('min_amount');
        $product->max_amount = $request->input('max_amount');
        $product->priority = $request->input('priority');
        $product->num_jineteo = $request->input('num_jineteo');
        $product->hours = $request->input('hours');
        $product->reassignment_minutes = $request->input('reassignment_minutes');
        $product->com_shp = $request->input('com_shp');
        $product->com_dis = $request->input('com_dis');
        $product->com_sup = $request->input('com_sup');
        $product->fixed_commission = $request->input('fixed_commission');

        if (isset($request->giros)) {
            $product->giros = intval($request->input('giros'));
        }

        $product->save();

        if ($request->hasFile('image')) {
            $pathName = Sprintf('products/%s.png', $product->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
            $client = new Client();
            $urlServer = getenv('URL_SERVER');
            $url = $urlServer."/upload.php";

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

        return redirect('products');
    }
}
