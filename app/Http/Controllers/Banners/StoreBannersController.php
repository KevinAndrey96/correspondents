<?php

namespace App\Http\Controllers\Banners;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class StoreBannersController extends Controller
{
    public function __invoke(Request $request)
    {
        $fields = [
            'image'=>'required|mimes:jpg,jpeg,png',
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];
        $this->validate($request, $fields, $message);

        $banner = new Banner();
        $banner->banner_url = '';
        $banner->save();

        if ($request->hasFile('image')) {
            $pathName = Sprintf('banners/%s.png', $banner->id);
            Storage::disk('public')->put($pathName, file_get_contents($request->file('image')));
            $client = new Client();
            $urlServer = getenv('URL_SERVER');
            $url = $urlServer."/upload.php";

            $client->request(RequestAlias::METHOD_POST, $url, [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(
                            str_replace('\\', '/', Storage::path('public\banners\\' .$banner->id . '.png')),'r'),
                    ],
                    [
                        'name' => 'path',
                        'contents' =>'banners'
                    ]
                ]
            ]);
            $banner->banner_url = '/storage/banners/' . $banner->id . '.png';
            $banner->save();
            unlink(str_replace('\\', '/', storage_path('app/public/banners/'.$banner->id.'.png')));
        }

        return redirect(route('banners.index'));
    }
}
