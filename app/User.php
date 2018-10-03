<?php

namespace ExamenEducacionMedia;

use ExamenEducacionMedia\Models\Subsistema;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups()
    {
        return $this->belongsToMany(Groups::class, 'group_user', 'user_id', 'group_id');
    }

    public function hasRole($role)
    {
        if ( ! is_array($role)) {
            return $this->groups()->where('descripcion', $role)->count();
        }
        $rolesDelUsuario = $this->groups->pluck('descripcion')->toArray();

        if (count(array_intersect($rolesDelUsuario, $role))) {
            return true;
        }

        return false;
    }

    public function subsistema()
    {
        return $this->hasOne(Subsistema::class, 'responsable_id');
    }
}
