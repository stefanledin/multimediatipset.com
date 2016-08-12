<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use \Auth;
use App\Question;

class StoreAnswerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
