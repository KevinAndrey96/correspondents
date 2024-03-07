<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use App\Models\Card;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class UpdateCardsController extends Controller
{
    public function __invoke(Request $request)
    {
        $fields = [
            'cardIMG'=>'mimes:jpg,jpeg,png',
            'cardPDF'=>'mimes:pdf',
            'qrIMG' => 'mimes:jpg,jpeg,png',
            'bank'=> 'required',
            'cardID' => 'string',
        ];

        $message = [
            'required'=>':attribute es requerido',
        ];

        $this->validate($request, $fields, $message);

        $cardID = intval($request->input('cardID'));
        $bank = $request->input('bank');
        $card = Card::find($cardID);
        $card->bank = $bank;
        $card->min_amount = floatval($request->input('minAmount'));
        $card->penalty = floatval($request->input('penalty'));
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

        if ($request->hasFile('qrIMG')) {
            $pathName = sprintf('card_qr_img/%s.png', $card->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('qrIMG')));
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
                                Storage::path('public\card_qr_img\\' . $card->id . '.png')
                            ),
                            'r'
                        )
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'card_qr_img'
                    ]
                ]
            ]);
            $card->qr_img = '/storage/card_qr_img/' . $card->id . '.png';
            $card->save();
            unlink(str_replace('\\', '/', storage_path('app/public/card_qr_img/'.$card->id.'.png')));
        }

        return redirect()->route('cards')->with('cardCreationSuccess', 'Creación de tarjeta de recaudo satisfactoria');

    }
}
