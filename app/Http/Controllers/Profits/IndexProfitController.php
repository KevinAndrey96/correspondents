<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexProfitController extends Controller
{
    public function index()
    {
        $profitsData['profits'] = Profit::all();
        return view('profit.index',$profitsData);
    }
}
