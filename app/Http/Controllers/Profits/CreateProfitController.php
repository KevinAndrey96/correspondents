<?php

namespace App\Http\Controllers\Profits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateProfitController extends Controller
{
    public function create()
    {
        return view('profit.WithdrawProfitController');
    }
}
