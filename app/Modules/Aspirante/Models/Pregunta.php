<?php

namespace Aspirante\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'ceneval_preguntas';

    public function diccionario()
    {
        return $this->belongsTo(Diccionario::class, 'diccionario_id');
    }

    public function padre()
    {
        return $this->belongsTo(Pregunta::class, 'padre_id');
    }

    public function hijos()
    {
        return $this->hasMany(Pregunta::class, 'padre_id');
    }
}
