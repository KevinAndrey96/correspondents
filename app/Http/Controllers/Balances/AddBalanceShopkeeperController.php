<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;
use Carbon\Carbon;

class AddBalanceShopkeeperController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role == 'Shopkeeper' or Auth::user()->role == 'Supplier') {
            $fields = [
                'amount'=>'required|numeric|min:20000',
                'image'=>'required',
                'transactionNumber'=>'required|unique',
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);

            $date = Carbon::now();
            $balance = new Balance();
            $balance->user_id = Auth::user()->id;
            $balance->amount = $request->input('amount');
            date_default_timezone_set('America/Bogota');
            $balance->date = $date;
            $balance->type = 'Deposit';
            $balance->code = $request->input('transactionNumber');
            $balance->save();
            if ($request->hasFile('image')) {
                $pathName = Sprintf('balances/%s.png', $balance->id);
                Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
                //dd(Storage::path('balances\\' .$balance->id . '.png'));
                //dd(Storage::disk('public')->path('balances/' .$balance->id . '.png'));
                $client = new Client();
                $url = "https://corresponsales.asparecargas.net/upload.php";
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace('\\', '/', Storage::disk('public')->path('balances/' .$balance->id . '.png')),'r'),
                        ],
                        [
                            'name' => 'path',
                            'contents' => 'balances'
                        ]
                    ]
                ]);
                $balance->boucher = '/storage/balances/' . $balance->id . '.png';
                $balance->save();
                unlink(str_replace('\\', '/', storage_path('app/public/balances/'.$balance->id.'.png')));
            }
    
            return redirect('home');
        }
    }
}
