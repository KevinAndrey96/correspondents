<?php

namespace App\Http\Controllers\Platforms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform;

class LockPlatformController extends Controller
{
    public function __invoke(Request $request)
    {
        $platform = Platform::find($request->input('id'));
        $platform->is_enabled = $request->input('status');
        $platform->save();
        return redirect('/home');

    }
}
