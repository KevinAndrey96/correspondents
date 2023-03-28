<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class StoreCardsController extends Controller
{
    public function __invoke(Request $request)
    {
        $fields = [
            'cardIMG'=>'required|mimes:jpg,jpeg,png',
            'cardPDF'=>'required|mimes:pdf',
            'bank'=>'required'
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $card = new Card();
        $card->bank = $request->input('bank');
        $card->cardIMG = '';
        $card->cardPDF = '';
        $card->save();

        if ($request->hasFile('cardPDF')) {
                $pathName = sprintf('card_pdf/%s.pdf', $card->id);
                Storage::disk('public')->put($pathName, file_get_contents($request->file('cardPDF')));
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
                                    Storage::path('public\card_pdf\\' . $card->id . '.pdf')
                                ),
                                'r'
                            )
                        ],
                        [
                            'name' => 'path',
                            'contents' => 'card_pdf'
                        ]
                    ]
                ]);
                $card->cardPDF = '/storage/card_pdf/' . $card->id . '.pdf';
                $card->save();
                unlink(str_replace('\\', '/', storage_path('app/public/card_pdf/'.$card->id.'.pdf')));
        }

        if ($request->hasFile('cardIMG')) {
            $pathName = sprintf('card_img/%s.png', $card->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('cardIMG')));
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
                                Storage::path('public\card_img\\' . $card->id . '.png')
                            ),
                            'r'
                        )
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'card_img'
                    ]
                ]
            ]);
            $card->cardIMG = '/storage/card_img/' . $card->id . '.png';
            $card->save();
            unlink(str_replace('\\', '/', storage_path('app/public/card_img/'.$card->id.'.png')));
        }

        return redirect()->route('cards')->with('cardCreationSuccess', 'Creación de tarjeta de recaudo satisfactoria');

    }
}
