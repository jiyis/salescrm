<?php
/**
 * Created by PhpStorm.
 * User: Gary.F.Dong
 * Date: 17-11-14
 * Time: 上午10:07
 * Desc:
 */

namespace App\Repository;

use App\Criteria\ProjectCriteria;
use App\Models\Project;


class ProjectRepository extends BaseRepository
{

    public function model()
    {
        return Project::class;
    }

    public function create(array $attributes, $guard = "admin")
    {
        //项目所有者
        $attributes['belong_user_id'] = auth()->guard($guard)->user()->id;
       /* if($guard == 'web') {
            $checkId = auth()->guard($guard)->user()->belong_to;
        } else {
            $checkId = 0;
        }
        $attributes['check_user_id'] = $checkId;*/
        return parent::create($attributes);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        parent::boot();
        $this->pushCriteria(app(ProjectCriteria::class));

    }
}