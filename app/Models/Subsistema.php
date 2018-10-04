<?php

namespace ExamenEducacionMedia\Models;

use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Subsistema extends Model
{
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
