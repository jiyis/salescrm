<?php

namespace App\Http\Requests\Admin;


class CreateProjectRequest extends Request
{

    public function rules()
    {
        return [
            'category'      => 'required|max:50',
            'city'          => 'required',
            'name'          => 'required',
            'business'      => 'required',
            'manager'       => 'required',
            'model'         => 'required',
            //'num'           => 'required|integer',
            'camera'        => 'required',
            'power'         => 'required',
            'delivery_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category.required'      => '项目类别不能为空',
            'city.required'          => '城市不能为空',
            'name.required'          => '项目名称不能为空',
            'business.required'      => '项目集成商不能为空',
            'manager.required'       => '项目集成商不能为空',
            'model.required'         => '项目型号/数量不能为空',
            'camera.required'        => '项目镜头不能为空',
            //'num.required'           => '项目镜头数量不能为空',
            'power.required'         => '项目把握度不能为空',
            'delivery_time.required' => '项目预计交货日期不能为空',
        ];
    }


}
