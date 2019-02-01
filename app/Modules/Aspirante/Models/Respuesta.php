<?php

namespace Aspirante\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table = 'ceneval_respuestas';

    public function diccionario()
    {
        return $this->belongsTo(Diccionario::class, 'diccionario_id');
    }
}
