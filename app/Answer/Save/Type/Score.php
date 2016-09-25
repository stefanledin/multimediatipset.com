<?php

namespace App\Answer\Save\Type;

use App\Answer;
use App\Question;
use \Auth;

class Score {
    
    public function __construct($answer, Question $question)
    {
        $this->store($answer, $question);
    }
    
    public function store($answer, Question $question)
    {
        $answer = new Answer([
            'answer' => str_replace(' ', '', $answer)
        ]);
        $question->answers()->save($answer);
        Auth::user()->answers()->save($answer);
    }

}