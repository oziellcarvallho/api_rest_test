<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $fillable = [
        'id', 'permission_id', 'user_id'
    ];
}
