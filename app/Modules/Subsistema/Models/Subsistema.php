<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-19
 * Time: 23:55
 */

namespace Subsistema\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Subsistema extends Model
{
    use Compoships;

    protected $table = 'subsistemas';

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function planteles()
    {
        return $this->hasMany(Plantel::class, 'subsistema_id');
    }

    public function especialidades()
    {
        return $this->hasMany(Especialidad::class, 'subsistema_id');
    }
}
