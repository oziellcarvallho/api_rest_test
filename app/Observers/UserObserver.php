<?php

namespace App\Observers;

use App\User;
use App\Models\Permissions\PermissionType;

class UserObserver
{
    public function created(User $user)
    {
        $permissions = [];
        foreach(PermissionType::where('type', $user->type)->get() as $permissionType) {
            $permissions[] = $permissionType->permission_id;
        }
        $user->permissions()->sync($permissions);
    }

    public function updated(User $user)
    {
        $permissions = [];
        foreach(PermissionType::where('type', $user->type)->get() as $permissionType) {
            $permissions[] = $permissionType->permission_id;
        }
        $user->permissions()->sync($permissions);
    }
}
