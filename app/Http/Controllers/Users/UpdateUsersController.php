<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        }
        $user->save();

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
        }


        if ($request->hasFile('rutPDF')) {
            $path = $_FILES['rutPDF']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            if ($extension == 'pdf') {
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
        }

        if (Auth::user()->role == 'Administrator' && $user->role == 'Shopkeeper') {
            return redirect('/users?role=allShopkeepers');
        }

        return redirect('/users?role='.$user->role);
    }
}
