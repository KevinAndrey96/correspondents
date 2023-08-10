<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Commission;
use App\Models\User;
use App\Models\Balance;
use App\Models\Summary;
use App\Models\Exchange;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class UpdateTransactionController extends Controller
{
    private const SUCCESSFUL_STATUS = 'successful';

    private const FAILURE_STATUS = 'failure';

    public function update(Request $request)
    {

            date_default_timezone_set('America/Bogota');
            $transaction = Transaction::find($request->input('transaction_id'));
            $shopkeeper = User::find($transaction->shopkeeper_id);
            $administrator = User::find($transaction->admin_id);
            $supplier = User::find($transaction->supplier_id);
            $distributor = User::find($transaction->distributor_id);
            $shopkeeper->daily_verified = 0;
            $shopkeeper->save();
            if (
                $transaction->status !== self::SUCCESSFUL_STATUS
                && $transaction->status !== self::FAILURE_STATUS
                && Summary::where([['movement_id', $transaction->id],['movement_type','!=','Recarga de Saldo']])->first() === null
            ) {
                $transaction->status = $request->input('status');
                $transaction->observation = $request->input('observation');
                $transaction->comment = $request->input('comment');
                $transaction->save();

                if ($request->hasFile('voucher')) {
                    $pathName = sprintf('voucher_images/%s.png', $transaction->id);
                    Storage::disk('public')->put($pathName, file_get_contents($request->file('voucher')));
                    $client = new Client();
                    $urlServer = getenv('URL_SERVER');
                    $url = $urlServer."/upload.php";
                        $client->request(RequestAlias::METHOD_POST, $url, [
                            'multipart' => [
                                [
                                    'name' => 'image',
                                    'contents' => fopen(
                                        str_replace(
                                            '\\',
                                            '/',
                                            Storage::path('public\voucher_images\\' . $transaction->id . '.png')
                                        ),
                                        'r'
                                    )
                                ],
                                [
                                    'name' => 'path',
                                    'contents' => 'voucher_images'
                                ]
                            ]
                        ]);

                    $transaction->voucher = '/storage/voucher_images/' . $transaction->id . '.png';
                    $transaction->save();
                    unlink(str_replace('\\', '/', storage_path('app/public/voucher_images/'.$transaction->id.'.png')));
                }

                if ($transaction->status === self::SUCCESSFUL_STATUS) {
                    if ($transaction->giros == 0) {
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



                        if (isset($commissionSupp)) {
                            $supplier->profit += $commissionSupp->amount;
                        }

                        $administrator->profit += ($transaction->com_adm + $transaction->product->fixed_commission);
                        $distributor->profit = $distributor->profit + $commissionDist->amount - $commissionShop->amount;
                        $shopkeeper->profit += $commissionShop->amount;

                    }


                    $supplierBalance = new Balance();
                    $shopkeeperBalance = new Balance();
                    $shopkeeperBalance->user_id = $shopkeeper->id;
                    $shopkeeperBalance->amount = $transaction->amount;
                    $shopkeeperBalance->date = Carbon::now();
                    $shopkeeperBalance->product_name = $transaction->product->product_name;
                    $shopkeeperBalance->is_valid = 1;
                    $shopkeeperBalance->indirect = 1;
                    $supplierBalance->user_id = $supplier->id;
                    $supplierBalance->amount = $transaction->amount;
                    $supplierBalance->date = Carbon::now();
                    $supplierBalance->product_name = $transaction->product->product_name;
                    $supplierBalance->is_valid = 1;
                    $supplierBalance->indirect = 1;
                    $supplierSummary = new Summary();
                    $shopkeeperSummary = new Summary();
                    $shopkeeperSummary->user_id = $shopkeeper->id;
                    $shopkeeperSummary->amount = $transaction->amount;
                    $shopkeeperSummary->previous_balance = $shopkeeper->balance;
                    $shopkeeperSummary->fixed_commission = $transaction->product->fixed_commission;
                    $shopkeeperSummary->product_name = $transaction->product->product_name;
                    $supplierSummary->user_id = $supplier->id;
                    $supplierSummary->amount = $transaction->amount;
                    $supplierSummary->previous_balance = $supplier->balance;
                    $supplierSummary->product_name = $transaction->product->product_name;
                    $supplierSummary->fixed_commission = $transaction->product->fixed_commission;
                    $exchange = Exchange::find(1);

                    if ($transaction->type === 'Withdrawal') {
                        $shopkeeper->balance += $transaction->amount - $transaction->product->fixed_commission;
                        $supplier->balance += $transaction->amount;
                        $shopkeeperBalance->type = 'Deposit';
                        $supplierBalance->type = 'Deposit';
                        $supplierSummary->movement_type = 'Retiro Realizado';
                        $shopkeeperSummary->movement_type = 'Retiro Realizado';
                    }

                    if ($transaction->type == 'Deposit') {
                        if ($transaction->giros == 0) {
                            $shopkeeper->balance -= ($transaction->amount + $transaction->product->fixed_commission);
                            $supplier->balance -= $transaction->amount;
                        } else {
                            $shopkeeper->balance -= ($transaction->amount + $transaction->product->fixed_commission)/($exchange->value);
                            $supplier->balance -= ($transaction->amount)/($exchange->value);
                        }



                        $shopkeeperBalance->type = 'Withdrawal';
                        $supplierBalance->type = 'Withdrawal';
                        $supplierSummary->movement_type = 'Deposito Realizado';
                        $shopkeeperSummary->movement_type = 'Deposito Realizado';
                    }

                    $supplierSummary->next_balance = $supplier->balance;
                    $shopkeeperSummary->next_balance = $shopkeeper->balance;
                    $supplier->save();
                    $distributor->save();
                    $shopkeeper->save();
                    $administrator->save();
                    $transaction->save();
                    $supplierBalance->save();
                    $shopkeeperBalance->save();
                    $supplierSummary->movement_id = $transaction->id;
                    $shopkeeperSummary->movement_id = $transaction->id;
                    $supplierSummary->save();
                    $shopkeeperSummary->save();
                }

                return redirect('/transactions');
            }

    }
}
