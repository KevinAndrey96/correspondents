<?php

namespace App\Http\Controllers\Banners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class indexBannersController extends Controller
{
    public function __invoke()
    {
        $banners = Banner::all();
        $urlServer = getenv('URL_SERVER');

        return view('banners.index', compact('banners', 'urlServer'));


    }
}
