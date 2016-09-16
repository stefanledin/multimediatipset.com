<?php

namespace App\Validators;

use Illuminate\Http\Request;
use \App\Question;

class AlternativesAnswerValidator {

    protected $question;

    function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['answer.'.$this->question->id] = 'required';
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [];
        $messages['answer.'.$this->question->id.'.required'] = 'Tipset för '.$this->question->title.' saknas';
        return $messages;   
    }

}