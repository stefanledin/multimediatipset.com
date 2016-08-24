<?php

namespace App\Validators;

use Illuminate\Http\Request;

class AnswerValidator
{
    public $rules;
    public $messages;

    function __construct(Request $request)
    {
        $type = $request->input('question_type');
        $validator = $this->getValidator($type, $request);

        $this->rules = $validator->rules();
        $this->messages = $validator->messages();
    }

    protected function getValidator($type, Request $request)
    {
        $validatorType = 'App\Validators\\'.$type.'AnswerValidator';
        return new $validatorType($request);
    }
}