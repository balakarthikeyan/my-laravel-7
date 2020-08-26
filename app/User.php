<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Permissions\UserRolesAndPermissionsTrait;

class User extends Authenticatable
{
    use Notifiable;
    use UserRolesAndPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'avatar', 'provider_id', 'provider', 'access_token'
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

    protected $guarded = ['*'];

    public function roles()
    {
        return $this->belongsToMany(\App\Role::class, 'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(\App\Permission::class, 'user_permissions');
    }
    
}
