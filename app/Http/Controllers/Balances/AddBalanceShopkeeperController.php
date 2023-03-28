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
        date_default_timezone_set('America/Bogota');
        if (Auth::user()->role == 'Shopkeeper' or Auth::user()->role == 'Supplier') {
            $fields = [
                'amount'=>'required|numeric|min:0',
                'image'=>'required',
                'product_id' => 'required',
                'payment_code' => 'required'
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);

            $date = Carbon::now();

            $lastBalance = Balance::where('user_id', Auth::user()->id)
                ->latest()
                ->first();

            $creationDate = Carbon::parse($lastBalance->created_at);

            $diffHours = $creationDate->diffInHours($date);

            $validDate = $creationDate->addHour()->format('h:i:s A');

            $sameBalance = Balance::where('payment_code',  $request->input('payment_code'))->get()->count();

            if ($sameBalance > 0) {
                return back()->with('requestAlreadyExists', 'Ya tienes una solicitud de retiro de saldo con este recibo');
            }

            if ($diffHours < 1) {
                return back()->with('failedBalanceSaved', 'Aun no tiene permitido solicitar saldo, lo podra hacer a partir de las '.$validDate);
            }

            $balance = new Balance();
            $balance->user_id = Auth::user()->id;
            $balance->amount = $request->input('amount');
            $balance->date = $date;
            $balance->type = 'Deposit';
            $balance->product_id = $request->input('product_id');
            $balance->payment_code =  $request->input('payment_code');
            $balance->save();
            if ($request->hasFile('image')) {
                $pathName = Sprintf('balances/%s.png', $balance->id);
                Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
                $client = new Client();
                $urlServer = getenv('URL_SERVER');
                $url = $urlServer."/upload.php";
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
