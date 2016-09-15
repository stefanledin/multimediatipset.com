<?php

namespace App\Validators;

use App\Question;;

class OrderAnswerValidator {

    protected $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

}