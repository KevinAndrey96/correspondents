<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBank;
use App\Models\ShopkeeperAdviser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class UpdateUsersController extends Controller
{
    public function update(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->document_type = $request->input('document_type');
        $user->document = $request->input('document');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->product_id = $request->input('product_id');

        if (isset($request->card_ids)) {
            $userBanks = UserBank::where('user_id', $user->id)->get();

            foreach ($userBanks as $userBank) {
                UserBank::destroy($userBank->id);
            }

            foreach ($request->card_ids as $cardID) {
                $userBank = new UserBank();
                $userBank->user_id = $user->id;
                $userBank->card_id = $cardID;
                $userBank->save();
            }
        }

        if (isset($request->max_queue)) {
            $user->max_queue = $request->input('max_queue');
        }
        if (isset($request->priority)) {
            $user->priority = $request->input('priority');
        }
        if (isset($request->password)) {
            if (strlen($request->password) < 7 || !preg_match('`[0-9]`',$request->password)
                || !preg_match('`[a-z]`', $request->password) ) {

                return back()->with('unfulfilledRequirements', 'La contraseña debe tener mínimo 7 caracteres, al menos una letra y al menos un número.');
            }
            $user->password = Hash::make($request->input('password'));
            $user->qr = 0;
            $user->first_login = 0;
            $user->daily_password_date = null;
        }
        $user->save();

        if ($user->role == 'Shopkeeper') {
            $shopkeeperAdviser = ShopkeeperAdviser::where('shopkeeper_id', $user->id)->first();
            if (isset($shopkeeperAdviser)) {
                $shopkeeperAdviser->adviser_id = $request->input('adviserID');
                $shopkeeperAdviser->save();
            } else {
                $shopkeeperAdviser = new ShopkeeperAdviser();
                $shopkeeperAdviser->shopkeeper_id = $user->id;
                $shopkeeperAdviser->adviser_id = $request->input('adviserID');
                $shopkeeperAdviser->save();
            }

        }

        if (! is_null($request->input('multiproductosID'))) {
            $user->multiproductosID = $request->input('multiproductosID');
            $user->save();
        }

        if (! is_null($request->input('platform_mul'))) {
            $user->platform_mul = $request->input('platform_mul');
            $user->save();
        }


        if ($request->hasFile('cedulaPDF')) {
            $path = $_FILES['cedulaPDF']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            if ($extension == 'pdf') {
                $pathName = sprintf('cedula_pdf/%s.pdf', $user->id);
            }

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $pathName = sprintf('cedula_pdf/%s.png', $user->id);
            }

            Storage::disk('public')->put($pathName, file_get_contents($request->file('cedulaPDF')));
            $client = new Client();
            $urlServer = getenv('URL_SERVER');
            $url = $urlServer."/upload.php";

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

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
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
            $urlServer = getenv('URL_SERVER');
            $url = $urlServer."/upload.php";

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
            $pathName = sprintf('camara_comercio_pdf/%s.pdf', $user->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('camara_comercio')));
            $client = new Client();
            $urlServer = getenv('URL_SERVER');
            $url =  $urlServer."/upload.php";

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
                        'contents' => 'camara_comercio_pdf'
                    ]
                ]
            ]);
            $user->camara_comercio = '/storage/camara_comercio_pdf/' . $user->id . '.pdf';
            $user->save();
            unlink(str_replace('\\', '/', storage_path('app/public/camara_comercio_pdf/'.$user->id.'.pdf')));
        }

        if ($request->hasFile('local_photo')) {
            $pathName = sprintf('local_photo_pdf/%s.png', $user->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('local_photo')));
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

        if (Auth::user()->role == 'Administrator' && $user->role == 'Shopkeeper') {
            return redirect('/users?role=allShopkeepers');
        }

        return redirect('/users?role='.$user->role);
    }
}
