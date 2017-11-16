<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Toastr;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function formatErrors(Validator $validator)
    {
        Toastr::error(implode('<br>',array_values($validator->errors()->all())));
        return $validator->errors()->all();
    }

    protected function failedValidation(Validator $validator)
    {
        Toastr::error(implode('<br>',array_values($validator->errors()->all())));
        throw new ValidationException($validator);
        //return $validator->errors()->all();
    }
}
