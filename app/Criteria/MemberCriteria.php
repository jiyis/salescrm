<?php

namespace App\Criteria;

use App\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Auth;

class MemberCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        if (Auth::guard('web')->check()) {
            return $model;
        }
        //如果是一级管理员，只能查看自己的
        if(Auth::guard('admin')->user()->hasRole('checker')) {
            $model = $model->where('belong_to', Auth::guard('admin')->user()->id);
        }

        return $model;
    }
}