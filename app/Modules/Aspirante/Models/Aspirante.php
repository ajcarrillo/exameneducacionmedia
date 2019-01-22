<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 11:30
 */

namespace Aspirante\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    use Compoships;

    protected $table    = 'aspirantes';
    protected $fillable = [
        'alumno_id', 'user_id', 'telefono', 'sexo', 'folio',
        'pais_nacimiento_id', 'entidad_nacimiento_id', 'domicilio_id',
        'informacion_procedencia_id', 'curp', 'fecha_nacimiento'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function informacionProcedencia()
    {
        return $this->belongsTo(InformacionProcedencia::class, 'informacion_procedencia_id');
    }
}
