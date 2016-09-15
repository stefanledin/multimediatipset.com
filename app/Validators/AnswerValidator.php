<?php

namespace App\Validators;

use Illuminate\Http\Request;
use App\Question;

class AnswerValidator
{
    public $rules;
    public $messages;

    function __construct(Question $question)
    {
        $validator = $this->getValidator($question);

        $this->rules = $validator->rules();
        $this->messages = $validator->messages();
    }

    protected function getValidator(Question $question)
    {
        $validatorType = 'App\Validators\\'.$question->type.'AnswerValidator';
        return new $validatorType($question);
    }
}