<?php

namespace ExamenEducacionMedia;

use ExamenEducacionMedia\Models\Plantel;
use ExamenEducacionMedia\Models\Subsistema;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'primer_apellido', 'segundo_apellido',
        'nombre_completo', 'email', 'username', 'password',
        'api_token', 'active', 'uuid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
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

    public function plantel()
    {
        return $this->hasOne(Plantel::class, 'responsable_id');
    }

    public static function createUser(array $data, array $roles): User
    {
        $user = User::create([
            'uuid'             => Uuid::uuid4()->toString(),
            'nombre'           => $data['nombre'],
            'primer_apellido'  => $data['primer_apellido'],
            'segundo_apellido' => $data['segundo_apellido'],
            'nombre_completo'  => "{$data['nombre']} {$data['primer_apellido']} {$data['segundo_apellido']}",
            'email'            => $data['email'],
            'username'         => $data['username'],
            'password'         => bcrypt($data['password']),
            'api_token'        => str_random(60),
            'active'           => true,
        ]);

        $user->groups()->sync($roles);

        return $user;
    }
}
