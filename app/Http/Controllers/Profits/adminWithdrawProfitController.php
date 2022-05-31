<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class adminWithdrawProfitController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role == 'Administrator') {
            $fields = [
                'image'=>'required',
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);
            $profit = Profit::find($request->input('profitID'));
            $profit->save();
            if ($request->hasFile('image')) {
                $pathName = Sprintf('profits/%s.png', $profit->id);
                Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
                //dd(Storage::path('profits\\' .$profit->id . '.png'));
                //dd(Storage::disk('public')->path('profits/' .$profit->id . '.png'));
                $client = new Client();
                $url = "https://corresponsales.asparecargas.net/upload.php";
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace('\\', '/', Storage::disk('public')->path('profits/' .$profit->id . '.png')),'r'),
                        ],
                        [
                            'name' => 'path',
                            'contents' => 'profits'
                        ]
                    ]
                ]);
                $profit->boucher = '/storage/profits/' . $profit->id . '.png';
                $profit->save();
                unlink(str_replace('\\', '/', storage_path('app/public/profits/'.$profit->id.'.png')));
            }

            return back();
        }
    }
}
