<?php

namespace App\Answer\Save\Type;

use App\Answer;
use App\Question;
use \Auth;

class Score {
    
    public function __construct($request)
    {
        $this->store($request->input('answer'));
    }
    
    public function store($answers)
    {
        foreach ($answers as $questionID => $answer) {
            $answer = new Answer([
                'answer' => $answer
            ]);
            $question = Question::find($questionID);
            $question->answers()->save($answer);
            Auth::user()->answers()->save($answer);
        }    
    }

}