<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use SoftDeletes;

    protected $fillable = ['fid', 'icon', 'name', 'display_name', 'description', 'is_menu', 'sort', 'guard_name'];
}
