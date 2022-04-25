<?php

namespace App\Http\Controllers\Balances;

use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AddBalanceShopkeeperController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role == 'Shopkeeper') {
            $fields = [
                'amount'=>'required|numeric|min:20000',
                'image'=>'required',
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);
    
            $date = Carbon::now();
            $balance = new Balance();
            $balance->user_id = Auth::user()->id;
            $balance->amount = $request->input('amount');
            $balance->type = $request->input('type');
            $balance->date = $date;
            /*
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
            */
            $balance->save();
    
            return redirect('home');
        }
    }
}
