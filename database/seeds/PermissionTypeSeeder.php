<?php

use Illuminate\Database\Seeder;
use App\Models\Permissions\Permission;
use App\Models\Permissions\PermissionType;
use App\User;

class PermissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userView = Permission::where('name', 'user-view')->first();
        $userCreate = Permission::where('name', 'user-create')->first();
        $userEdit = Permission::where('name', 'user-edit')->first();
        $userDelete = Permission::where('name', 'user-delete')->first();

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $userView->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $userCreate->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $userEdit->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $userDelete->id
        ]);

        $projectView = Permission::where('name', 'project-view')->first();
        $projectCreate = Permission::where('name', 'project-create')->first();
        $projectEdit = Permission::where('name', 'project-edit')->first();
        $projectDelete = Permission::where('name', 'project-delete')->first();

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $projectView->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $projectCreate->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $projectEdit->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $projectDelete->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_EXECUTIONER, 
            'permission_id' => $projectView->id
        ]);

        $taskView = Permission::where('name', 'task-view')->first();
        $taskCreate = Permission::where('name', 'task-create')->first();
        $taskEdit = Permission::where('name', 'task-edit')->first();
        $taskDelete = Permission::where('name', 'task-delete')->first();

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $taskView->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $taskCreate->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $taskEdit->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_MANAGER, 
            'permission_id' => $taskDelete->id
        ]);

        PermissionType::firstOrCreate([
            'type' => User::TYPE_EXECUTIONER, 
            'permission_id' => $taskView->id
        ]);
    }
}
