<?php

namespace App\Http\Controllers\Publicity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicity;

class DeletePublicityController extends Controller
{
    public function __invoke($id)
    {
        $publicity = Publicity::find($id);
        $publicity->is_deleted = 1;
        $publicity->save();

        return back();
    }
}
