<?php

namespace App\Http\Controllers\Answers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;

class StoreAnswersController extends Controller
{
    public function __invoke(Request $request)
    {
        $answer = new Answer();
        $answer->answer = $request->input('answer-text');
        $answer->is_deleted = 0;
        $answer->save();

        return redirect()->route('answers.index');
    }
}
