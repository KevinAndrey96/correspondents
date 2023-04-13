<?php

namespace App\Http\Controllers\Answers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;

class DeleteAnswersController extends Controller
{
    public function __invoke($id)
    {
        $answer = Answer::find($id);
        $answer->is_deleted = 1;
        $answer->save();

        return back();
    }
}
