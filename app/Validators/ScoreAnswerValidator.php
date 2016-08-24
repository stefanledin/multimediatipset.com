<?php

namespace App\Validators;

use Illuminate\Http\Request;
use \App\Question;

class ScoreAnswerValidator {

    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        foreach ($this->request->get('answer') as $questionID => $value) {
            $rules['answer.'.$questionID] = 'required';
        }
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
        foreach ($this->request->get('answer') as $questionID => $value) {
            $question = Question::find($questionID);
            $messages['answer.'.$questionID.'.required'] = 'Tipset för '.$question->title.' saknas';
        }
        return $messages;   
    }

}