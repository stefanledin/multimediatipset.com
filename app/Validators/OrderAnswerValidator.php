<?php

namespace App\Validators;

use Illuminate\Http\Request;

class OrderAnswerValidator {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
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