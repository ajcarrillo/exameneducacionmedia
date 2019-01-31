<?php

namespace Aspirante\Models;

use Illuminate\Database\Eloquent\Model;

class Diccionario extends Model
{
    protected $table = 'ceneval_diccionarios';

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'diccionario_id', 'id');
    }
}
