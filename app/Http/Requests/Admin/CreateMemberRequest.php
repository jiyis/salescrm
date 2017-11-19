<?php

namespace App\Http\Requests\Admin;


use Illuminate\Validation\Rule;

class CreateMemberRequest extends Request
{

    public function rules()
    {
        return [
            'name' => 'required|max:20|alpha_dash',
            'nickname' => 'string|max:50',
            'email' => 'email|unique:users',
            'password' => 'sometimes|max:20',
            'category'     => [
                'required',
                'integer',
                Rule::unique('users')->where(function ($query) {
                    $query->where('name', $this->input('name'));
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名称不能为空',
            'name.alpha_dash' => '用户仅允许字母、数字、破折号（-）以及底线（_）',
            'name.max' => '用户名称最多20个字符',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱非法',
            'password.max' => '密码最多20个字符',
            'category.required' => '产品类别不能为空',
            'category.unique' => '用户已存在',
        ];
    }


}
