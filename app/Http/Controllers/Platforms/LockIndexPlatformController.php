<?php

namespace App\Http\Controllers\Platforms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform;

class LockIndexPlatformController extends Controller
{
    public function __invoke()
    {
        $platform = Platform::find(1);

        return view('platform.lockIndex', compact('platform'));
    }
}
