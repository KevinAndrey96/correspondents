<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class StoreDistributorExtrainfoUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $fields = [
            'multiproductosID'=>'required|string',
            'platform_mul'=>'required|string',
            'cedulaPDF'=>'required|mimes:pdf',
            'rutPDF'=>'required|mimes:pdf'
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $user = User::find(Auth::user()->id);
        $user->multiproductosID = $request->input('multiproductosID');
        $user->platform_mul = $request->input('platform_mul');
        $user->save();

        if ($request->hasFile('cedulaPDF')) {
            $pathName = sprintf('cedula_pdf/%s.pdf', $user->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('cedulaPDF')));
            $client = new Client();
            $url = "https://testing.asparecargas.net/upload.php";

            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace(
                                '\\',
                                '/',
                                Storage::path('public\cedula_pdf\\' . $user->id . '.pdf')
                            ),
                            'r'
                        )
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'cedula_pdf'
                    ]
                ]
            ]);
            $user->cedulaPDF = '/storage/cedula_pdf/' . $user->id . '.pdf';
            $user->save();
        }

        if ($request->hasFile('rutPDF')) {
            $pathName = sprintf('rut_pdf/%s.pdf', $user->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('rutPDF')));
            $client = new Client();
            $url = "https://testing.asparecargas.net/upload.php";

            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace(
                                '\\',
                                '/',
                                Storage::path('public\rut_pdf\\' . $user->id . '.pdf')
                            ),
                            'r'
                        )
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'rut_pdf'
                    ]
                ]
            ]);
            $user->rutPDF = '/storage/rut_pdf/' . $user->id . '.pdf';
            $user->save();
        }

        $user->extrainfo = 1;
        $user->save();

        return redirect()->route('home');
    }
}
