<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateBrandsController extends Controller
{
    public function __invoke()
    {
        return view('brands.create');
    }
}
