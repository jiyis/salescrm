<?php
/**
 * Created by PhpStorm.
 * User: Gary.F.Dong
 * Date: 17-11-13
 * Time: 下午2:32
 * Desc:
 */

namespace App\Repository;


use App\User;


class MemberRepository extends BaseRepository
{

    public function model()
    {
        return User::class;
    }


    public function create(array $attributes)
    {
        $attributes['belong_to'] = auth()->guard('admin')->user()->id;
        return parent::create($attributes);
    }

}