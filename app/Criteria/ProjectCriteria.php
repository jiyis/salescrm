<?php

namespace App\Criteria;

use App\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Auth;

class ProjectCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        //如果是前段用户访问
        if (Auth::guard('web')->check()) {
            $model = $model->where('belong_user_id', Auth::guard('web')->user()->id);
        } elseif(Auth::guard('admin')->user()->hasRole('checker')) {  //如果后台是审核人登录，只能查看自己所管理的客户的
            $user_id = User::where(['belong_to' => Auth::guard('admin')->user()->id])->get();
            $model = $model->whereIn('belong_user_id',$user_id->pluck('id')->toArray());
        } else {
            
        }
        return $model;
    }
}