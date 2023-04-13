<?php

namespace App\Http\Controllers\Answers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateAnswersController extends Controller
{
    public function __invoke()
    {
        return view('answers.create');
    }
}
