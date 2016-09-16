<?php

namespace App\Answer\Save\Type;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use \Auth;

class Order {

    public function __construct($answer, Question $question)
    {
        $this->store($answer, $question);
    }

    public function store($answer, Question $question)
    {
        $answer = new Answer([
            'answer' => $answer
        ]);
        $question->answers()->save($answer);
        Auth::user()->answers()->save($answer);
    }

}