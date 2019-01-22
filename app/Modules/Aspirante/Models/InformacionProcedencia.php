<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-22
 * Time: 10:08
 */

namespace Aspirante\Models;


use Illuminate\Database\Eloquent\Model;

class InformacionProcedencia extends Model
{
    protected $table    = 'informacion_procedencias';
    protected $fillable = [
        'clave_centro_trabajo', 'nombre_centro_trabajo', 'turno_id',
        'fecha_egreso', 'primera_vez',
    ];

    public function aspirante()
    {
        return $this->hasOne(InformacionProcedencia::class, 'informacion_procedencia_id');
    }
}
