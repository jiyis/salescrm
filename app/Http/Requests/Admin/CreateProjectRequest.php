<?php

namespace App\Http\Requests\Admin;


class CreateProjectRequest extends Request
{

    public function rules()
    {
        return [
            'category' => 'required',
            'city' => 'required',
            'name' => 'required',
            'business' => 'required',
            'manager' => 'required',
            'model' => 'required',
            'num' => 'required',
            'camera' => 'required',
            'power' => 'required',
            'delivery_time' => 'required',
            'remarks' => 'required',
        ];
    }


}
