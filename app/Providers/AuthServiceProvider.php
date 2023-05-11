<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use App\Models\Permissions\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach ($this->listPermissions() as $permission) {
            Gate::define($permission->name, function($user) use($permission){
                return  $user->existPermission($permission->id) || $user->isSuperAdmin();
            });
        }
    }

    public function listPermissions()
    {
        return App::runninginConsole() ? [] : (Schema::hasTable('permissions') ? Permission::get() : []);
    }
}
