<?php
/**
 * Created by PhpStorm.
 * User: Gary.F.Dong
 * Date: 17-11-14
 * Time: 上午10:07
 * Desc:
 */

namespace App\Repository;

use App\Models\Project;



class ProjectRepository extends BaseRepository
{

    public function model()
    {
        return Project::class;
    }

    public function create(array $attributes)
    {
        $attributes['user_id'] = auth()->user()->id;
        return parent::create($attributes);
    }

}