<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class JsonRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        exit(json_encode($validator->getMessageBag()->toArray()));
    }

}
