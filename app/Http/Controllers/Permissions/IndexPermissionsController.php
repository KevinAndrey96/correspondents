<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexPermissionsController extends Controller
{
    public function __invoke()
    {
        return view('permissions.index');
    }
}
