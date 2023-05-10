<?php

namespace App\Http\Controllers\Publicity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatePublicityController extends Controller
{
    public function __invoke()
    {
        return view('publicity.create');
    }
}
