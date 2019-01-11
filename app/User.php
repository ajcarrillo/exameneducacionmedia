<?php

namespace ExamenEducacionMedia;

use Awobaz\Compoships\Compoships;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Traits\HasRoles;
use Subsistema\Models\Plantel;
use Subsistema\Models\Subsistema;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Compoships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_completo', 'email', 'username', 'password',
        'api_token', 'active', 'uuid', 'jarvis_user_access_token',
        'provider', 'provider_id', 'jarvis_user_token_type', 'jarvis_user_token_expires_in',
        'jarvis_user_refresh_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'jarvis_user_access_token',
        'jarvis_user_token_type', 'jarvis_user_token_expires_in', 'jarvis_user_refresh_token',
    ];

    public function groups()
    {
        return $this->belongsToMany(Groups::class, 'group_user', 'user_id', 'group_id');
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
            'uuid'            => Uuid::uuid4()->toString(),
            'nombre_completo' => $data['nombre_completo'],
            'email'           => $data['email'],
            'username'        => $data['email'],
            'password'        => bcrypt($data['password']),
            'api_token'       => str_random(60),
            'active'          => true,
        ]);

        $user->assignRole($roles);

        return $user;
    }

    protected static function extractJarvisUserInfo(array $data, array $token)
    {
        return [
            'uuid'                         => Uuid::uuid4()->toString(),
            'nombre_completo'              => $data['persona']['nombre_completo'],
            'email'                        => $data['email'],
            'username'                     => $data['email'],
            'api_token'                    => str_random(60),
            'active'                       => true,
            'provider_id'                  => $data['uuid'],
            'provider'                     => 'jarvis',
            'jarvis_user_access_token'     => $token['access_token'],
            'jarvis_user_token_type'       => $token['token_type'],
            'jarvis_user_token_expires_in' => $token['expires_in'],
            'jarvis_user_refresh_token'    => $token['refresh_token'],
        ];
    }

    public static function findOrCreateJarvisUser(array $data, array $token): User
    {
        try {
            $user = User::where('provider_id', $data['uuid'])->firstOrFail();
            $user->update(User::extractJarvisUserInfo($data, $token));
        } catch (\Exception $e) {
            $user = User::create(User::extractJarvisUserInfo($data, $token));
            $user->assignRole('invitado');
        }

        return $user;
    }

    public static function crearUsuario(array $data)
    {
        $user = User::create($data);
        $user->assignRole('invitado');

        return $user;
    }

    public static function actualizarUsuario(User $user, array $data)
    {
        $user->update($data);

        return $user;
    }

}
