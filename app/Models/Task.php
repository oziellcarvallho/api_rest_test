<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'title', 'description', 'deadline', 'executor_id', 'project_id'
    ];

    public function executor()
    {
        return $this->hasOne(User::class, 'id', 'executor_id');
    }

    public function project()
    {
        return $this->hasOne(User::class, 'id', 'project_id');
    }
}
