<?php

namespace App\Http\Controllers\Publicity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadPublicityController extends Controller
{
    public function __invoke($id)
    {
        $urlServer = getenv('URL_SERVER');

        return response()->download(storage_path('app/public/publicity/'.$id.'.png'));
    }
}
