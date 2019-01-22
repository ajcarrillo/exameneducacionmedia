<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 11:30
 */

namespace Aspirante\Models;


use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    protected $table    = 'aspirantes';
    protected $fillable = [
        'alumno_id', 'user_id', 'telefono', 'sexo', 'folio',
        'pais_nacimiento_id', 'entidad_nacimiento_id', 'domicilio_id',
        'informacion_procedencia', 'curp', 'fecha_nacimiento'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
