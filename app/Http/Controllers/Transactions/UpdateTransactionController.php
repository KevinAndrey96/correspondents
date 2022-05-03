<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Commission;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class UpdateTransactionController extends Controller
{
    public function update(Request $request)
    {
        $transaction = Transaction::find($request->input('transaction_id'));
        $transaction->status = $request->input('status');
        $transaction->comment = $request->input('comment');
        $transaction->save();
        if ($request->hasFile('voucher')) {
            $pathName = Sprintf('voucher_images/%s.png', $transaction->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('voucher')));
            $client = new Client();
            $url = "https://corresponsales.asparecargas.net/upload.php";
            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace('\\', '/', Storage::path('public\voucher_images\\' . $transaction->id . '.png')), 'r')
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'voucher_images'
                    ]
                ]
            ]);
            $transaction->voucher = '/storage/voucher_images/' . $transaction->id . '.png';
            $transaction->save();
        }
        $commissionShop = Commission::where([
                                            ['user_id', '=', $transaction->shopkeeper_id],
                                            ['product_id', '=', $transaction->product_id]
                                            ])->first();
        $commissionDist = Commission::where([
                                            ['user_id', '=', $transaction->distributor_id],
                                            ['product_id', '=', $transaction->product_id]
                                            ])->first();
        $commissionSupp = Commission::where([
                                            ['user_id', '=', $transaction->supplier_id],
                                            ['product_id', '=', $transaction->product_id]
                                            ])->first();
        $transaction->com_shp = $commissionShop->amount;
        $transaction->com_dis = $commissionDist->amount - $commissionShop->amount;
        $transaction->com_sup = $commissionSupp->amount;
        $transaction->com_adm = $transaction->product->product_commission -
                                ($transaction->com_shp + $transaction->com_dis + $transaction->com_sup );
        $transaction->save();

        return redirect('/transactions');
    }
}
