<?php

namespace App\Http\Controllers\Banners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateBannersController extends Controller
{
    public function __invoke()
    {
        return view('banners.create');
    }
}
