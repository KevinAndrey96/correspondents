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
            'multiproductosID' => 'required|string',
            'platform_mul' => 'required|string',
            'cedulaPDF' => 'required|mimes:jpg,jpeg,png,pdf',
            'rutPDF' => 'mimes:jpg,jpeg,png,pdf',
            'camara_comercio' => 'mimes:jpg,jpeg,png,pdf',
            'local_photo' => 'required|mimes:jpg,jpeg,png',
            'public_receipt' => 'required|mimes:jpg,jpeg,png'
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
            $path = $_FILES['cedulaPDF']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            if ($extension == 'pdf') {
                $pathName = sprintf('cedula_pdf/%s.pdf', $user->id);
            }

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'PNG') {
                $pathName = sprintf('cedula_pdf/%s.png', $user->id);
            }

            Storage::disk('public')->put($pathName, file_get_contents($request->file('cedulaPDF')));
            $client = new Client();
            $countryName = getenv('COUNTRY_NAME');
            $url = "https://corresponsales.asparecargas.net/upload.php";
            if ($countryName == 'ECUADOR') {
                $url = "https://transacciones.asparecargas.net/upload.php";
            }

            if ($extension == 'pdf') {
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
                unlink(str_replace('\\', '/', storage_path('app/public/cedula_pdf/'.$user->id.'.pdf')));
            }

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'PNG') {
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace(
                                    '\\',
                                    '/',
                                    Storage::path('public\cedula_pdf\\' . $user->id . '.png')
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
                $user->cedulaPDF = '/storage/cedula_pdf/' . $user->id . '.png';
                unlink(str_replace('\\', '/', storage_path('app/public/cedula_pdf/'.$user->id.'.png')));
            }
            $user->save();
        }

        if ($request->hasFile('rutPDF')) {
            $path = $_FILES['rutPDF']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            if ($extension == 'pdf') {
                $pathName = sprintf('rut_pdf/%s.pdf', $user->id);
            }

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $pathName = sprintf('rut_pdf/%s.png', $user->id);
            }

            Storage::disk('public')->put($pathName, file_get_contents($request->file('rutPDF')));
            $client = new Client();
            $countryName = getenv('COUNTRY_NAME');
            $url = "https://corresponsales.asparecargas.net/upload.php";
            if ($countryName == 'ECUADOR') {
                $url = "https://transacciones.asparecargas.net/upload.php";
            }
            if ($extension == 'pdf') {
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
                unlink(str_replace('\\', '/', storage_path('app/public/rut_pdf/'.$user->id.'.pdf')));
            }

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace(
                                    '\\',
                                    '/',
                                    Storage::path('public\rut_pdf\\' . $user->id . '.png')
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
                $user->rutPDF = '/storage/rut_pdf/' . $user->id . '.png';
                unlink(str_replace('\\', '/', storage_path('app/public/rut_pdf/'.$user->id.'.png')));
            }

            $user->save();
        }

        if ($request->hasFile('camara_comercio')) {
            $path = $_FILES['camara_comercio']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            if ($extension == 'pdf') {
                $pathName = sprintf('camara_comercio_pdf/%s.pdf', $user->id);
            }

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'PNG') {
                $pathName = sprintf('camara_comercio_pdf/%s.png', $user->id);
            }

            Storage::disk('public')->put($pathName, file_get_contents($request->file('camara_comercio')));
            $client = new Client();
            $countryName = getenv('COUNTRY_NAME');
            $url = "https://corresponsales.asparecargas.net/upload.php";
            if ($countryName == 'ECUADOR') {
                $url = "https://transacciones.asparecargas.net/upload.php";
            }
            if ($extension == 'pdf') {
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace(
                                    '\\',
                                    '/',
                                    Storage::path('public\camara_comercio_pdf\\' . $user->id . '.pdf')
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
                $user->camara_comercio = '/storage/camara_comercio_pdf/' . $user->id . '.pdf';
                unlink(str_replace('\\', '/', storage_path('app/public/camara_comercio_pdf/'.$user->id.'.pdf')));
            }

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'PNG') {
                $client->request(RequestAlias::METHOD_POST, $url, [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen(
                                str_replace(
                                    '\\',
                                    '/',
                                    Storage::path('public\camara_comercio_pdf\\' . $user->id . '.png')
                                ),
                                'r'
                            )
                        ],
                        [
                            'name' => 'path',
                            'contents' => 'camara_comercio_pdf'
                        ]
                    ]
                ]);
                $user->camara_comercio = '/storage/camara_comercio_pdf/' . $user->id . '.png';
                unlink(str_replace('\\', '/', storage_path('app/public/camara_comercio_pdf/'.$user->id.'.png')));
            }

            $user->save();
        }

        if ($request->hasFile('local_photo')) {
            $pathName = sprintf('local_photo_pdf/%s.png', $user->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('local_photo')));
            $client = new Client();
            $countryName = getenv('COUNTRY_NAME');
            $url = "https://corresponsales.asparecargas.net/upload.php";
            if ($countryName == 'ECUADOR') {
                $url = "https://transacciones.asparecargas.net/upload.php";
            }

            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace(
                                '\\',
                                '/',
                                Storage::path('public\local_photo_pdf\\' . $user->id . '.png')
                            ),
                            'r'
                        )
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'local_photo_pdf'
                    ]
                ]
            ]);
            $user->local_photo = '/storage/local_photo_pdf/' . $user->id . '.png';
            $user->save();
            unlink(str_replace('\\', '/', storage_path('app/public/local_photo_pdf/'.$user->id.'.png')));
        }

        if ($request->hasFile('public_receipt')) {
            $pathName = sprintf('public_receipts/%s.png', $user->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('public_receipt')));
            $client = new Client();
            $countryName = getenv('COUNTRY_NAME');
            $url = "https://corresponsales.asparecargas.net/upload.php";
            if ($countryName == 'ECUADOR') {
                $url = "https://transacciones.asparecargas.net/upload.php";
            }

            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace(
                                '\\',
                                '/',
                                Storage::path('public\public_receipts\\' . $user->id . '.png')
                            ),
                            'r'
                        )
                    ],
                    [
                        'name' => 'path',
                        'contents' => 'public_receipts'
                    ]
                ]
            ]);

            $user->public_receipt = '/storage/public_receipts/' . $user->id . '.png';
            $user->save();
            unlink(str_replace('\\', '/', storage_path('app/public/public_receipts/'.$user->id.'.png')));
        }

        $user->extrainfo = 1;
        $user->save();

        if ($user->qr == 0) {
            return redirect()->route('complete.registration');
        }

        return redirect()->route('home');
    }
}
