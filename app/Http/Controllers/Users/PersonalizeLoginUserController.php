<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class PersonalizeLoginUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $brand = $request->input('brand');

        if (isset($brand)) {
            $brand = Brand::where('domain', $brand)->first();
            return view('auth.login', ['brand' => $brand]);
        }

        return view('auth.login');;


    }
}
