<?php

namespace ExamenEducacionMedia\Models;

use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
    protected $table = 'planteles';
    protected $guarded = [];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class, 'subsistema_id');
    }

    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'domicilio_id');
    }
}
