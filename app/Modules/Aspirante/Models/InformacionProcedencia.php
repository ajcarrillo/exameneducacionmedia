<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-22
 * Time: 10:08
 */

namespace Aspirante\Models;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class InformacionProcedencia extends Model
{
    use Compoships;

    protected $table    = 'informacion_procedencias';
    protected $fillable = [
        'clave_centro_trabajo', 'nombre_centro_trabajo', 'turno_id',
        'fecha_egreso', 'primera_vez',
    ];

    public function aspirante()
    {
        return $this->hasOne(Aspirante::class, 'informacion_procedencia_id');
    }

    public function getNombreCompuestoAttribute()
    {
        return $this->clave_centro_trabajo . ' - ' . $this->nombre_centro_trabajo;
    }

    public function getPrimeraVezTextoAttribute()
    {
        return $this->primera_vez ? 'Si' : 'No';
    }
}
