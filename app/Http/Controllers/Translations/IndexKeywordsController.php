<?php

namespace App\Http\Controllers\Translations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexKeywordsController extends Controller
{
    public function __invoke()
    {
        return view('translations.keywords');
    }
}
