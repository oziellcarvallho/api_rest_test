<?php

use App\User;
use App\Models\Permissions\PermissionType;
use Illuminate\Database\Seeder;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereIn('email', ['gerente@teste.com', 'executor@teste.com'])->get();
        foreach($users as $user) {
            $permissions = [];
            foreach(PermissionType::where('type', $user->type)->get() as $permissionType) {
                $permissions[] = $permissionType->permission_id;
            }
            $user->permissions()->sync($permissions);
        }
    }
}
