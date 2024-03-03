<?php

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

function uploadFile(UploadedFile $file, string $fileName, string $path)
{
    $pathName = sprintf($path.'/%s.png', $fileName);
    Storage::disk('public')->put($pathName, file_get_contents($file));
    $client = new Client();
    $url = getenv('URL_UPLOADER');

    $client->request(RequestAlias::METHOD_POST, $url, [
        'multipart' => [
            [
                'name' => 'image',
                'contents' => fopen(
                    str_replace('\\', '/', storage_path('app/public/'.$path.'/'.$fileName.'.png')),
                    'r'
                )
            ],
            [
                'name' => 'path',
                'contents' => $path
            ]
        ]
    ]);
    unlink(str_replace('\\', '/', storage_path('app/public/'.$path.'/'.$fileName.'.png')));
}

function amountFormat(string $amount)
{
    $amountLength = strlen($amount);

    if ($amountLength > 1) {

    $spotPosition = strpos($amount, '.') + 1;

    if ($amountLength == $spotPosition) {
        $amount = substr($amount, 0, -1);
    }

    $amount = str_replace(',','', $amount);
    }

    return $amount;
}
