<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class UpdateTransactionController extends Controller
{
    public function update(Request $request)
    {
        try {
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
            if ($transaction->status == 'successful') {
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
                if (isset($commissionSupp)) {
                    $transaction->com_sup = $commissionSupp->amount;
                }
                $transaction->com_adm = $transaction->product->product_commission -
                    ($transaction->com_shp + $transaction->com_dis + $transaction->com_sup);

                $administrator = User::find($transaction->admin_id);
                $supplier = User::find($transaction->supplier_id);
                $distributor = User::find($transaction->distributor_id);
                $shopkeeper = User::find($transaction->shopkeeper_id);
                $com_adm = $transaction->product->product_commission -
                    ($transaction->com_shp + $transaction->com_dis + $transaction->com_sup);
                if ($com_adm >= 0) {
                    $administrator->profit = $administrator->profit + $com_adm;
                }
                if (isset($commissionSupp)) {
                    $supplier->profit = $supplier->profit + $commissionSupp->amount;
                }
                $distributor->profit = $distributor->profit + $commissionDist->amount - $commissionShop->amount;
                $shopkeeper->profit = $shopkeeper->profit + $commissionShop->amount;
                $supplier->save();
                $distributor->save();
                $shopkeeper->save();
                $transaction->save();
            }

            return redirect('/transactions');
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
