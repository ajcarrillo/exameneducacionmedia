<?php

namespace Aspirante\Models;

use Illuminate\Database\Eloquent\Model;

class AspiranteRespuesta extends Model
{
    protected $table = 'aspirante_cuestionario_de_contexto';

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'pregunta_id');
    }

    public function respuesta()
    {
        return $this->belongsTo(Respuesta::class, 'respuesta_id');
    }

    public function aspirante()
    {
        return $this->belongsTo(Aspirante::class, 'aspirante_id');
    }
}
