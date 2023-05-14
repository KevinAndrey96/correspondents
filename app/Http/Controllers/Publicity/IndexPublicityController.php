<?php

namespace App\Http\Controllers\Publicity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicity;

class IndexPublicityController extends Controller
{
    public function __invoke()
    {
        $publicity = Publicity::where('is_deleted', 0)->get();

        return view('publicity.index', compact('publicity'));
    }
}
