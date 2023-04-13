<?php

namespace App\Http\Controllers\Answers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;

class IndexAnswersController extends Controller
{
    public function __invoke()
    {
        $answers = Answer::where('is_deleted', 0)->get();

        return view('answers.index', compact('answers'));
    }
}
