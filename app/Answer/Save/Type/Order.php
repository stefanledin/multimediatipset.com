<?php

namespace App\Answer\Save\Type;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use \Auth;

class Order {

    public function __construct(Request $request)
    {
        $this->store($request);
    }

    public function store(Request $request)
    {
        $answer = new Answer([
            'answer' => $request->input('answer')
        ]);
        $question = Question::find($request->input('question_id'));
        $question->answers()->save($answer);
        Auth::user()->answers()->save($answer);
    }

}