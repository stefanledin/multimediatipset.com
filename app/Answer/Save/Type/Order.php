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
        foreach ($request->input('answer') as $question_id => $answer) {
            
            $answer = new Answer([
                'answer' => $answer
            ]);
            $question = Question::find($question_id);
            $question->answers()->save($answer);
            Auth::user()->answers()->save($answer);

        }
    }

}