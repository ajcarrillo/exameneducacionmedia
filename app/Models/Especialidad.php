<?php

namespace ExamenEducacionMedia\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class, 'subsistema_id');
    }
}
