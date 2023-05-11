<?php

namespace App;

use App\Models\Permissions\Permission;
use App\Models\Permissions\PermissionUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    const TYPE_SUPER_ADMIN = 'super_admin';
    const TYPE_MANAGER = 'manager';
    const TYPE_EXECUTIONER = 'executioner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cpf', 'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getTypes()
    {
        return [self::TYPE_MANAGER, self::TYPE_EXECUTIONER];
    }

    public function isSuperAdmin()
    {
        return $this->attributes['type'] === self::TYPE_SUPER_ADMIN;
    }

    public function isManager()
    {
        return $this->attributes['type'] === self::TYPE_MANAGER;
    }

    public function isExecutioner()
    {
        return $this->attributes['type'] === self::TYPE_EXECUTIONER;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_users', 'user_id' ,'permission_id');
    }

    public function existPermission($permission)
    {
        return PermissionUser::where('user_id', $this->id)->where('permission_id', $permission)->count() > 0 ? true : false;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
