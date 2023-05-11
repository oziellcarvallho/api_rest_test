<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionType extends Model
{
    protected $fillable = [
        'id', 'type', 'permission_id'
    ];

    public function permission()
    {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }
}
