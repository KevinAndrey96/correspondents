<?php

namespace App\Http\Controllers\Banners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class DeleteBannersController extends Controller
{
    public function __invoke($id)
    {
        Banner::destroy($id);

        return redirect(route('banners.index'));
    }
}
