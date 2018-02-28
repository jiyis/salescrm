<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use SoftDeletes;

    protected $fillable = ['category', 'city', 'name', 'business', 'manager', 'model', 'num', 'camera','power','delivery_time','remarks','report', 'report_time', 'files', 'belong_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'belong_user_id', 'id');
    }
}
