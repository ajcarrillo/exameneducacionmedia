<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 11:30
 */

namespace Aspirante\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\Models\Entidad;
use ExamenEducacionMedia\Models\Geodatabase\Pais;
use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    use Compoships;

    protected $table    = 'aspirantes';
    protected $fillable = [
        'alumno_id', 'user_id', 'telefono', 'sexo', 'folio',
        'pais_nacimiento_id', 'entidad_nacimiento_id', 'domicilio_id',
        'informacion_procedencia_id', 'curp', 'fecha_nacimiento',
        'curp_historica', 'curp_valida',
    ];
    protected $casts    = [
        'curp_historica'   => 'boolean',
        'curp_valida'      => 'boolean',
        'fecha_nacimiento' => 'datetime:Y-m-d',
    ];
    protected $appends  = [
        'is_aspirante_externo',
    ];

    public function paisNacimiento()
    {
        return $this->belongsTo(Pais::class, 'pais_nacimiento_id');
    }

    public function entidadNacimiento()
    {
        return $this->belongsTo(Entidad::class, 'entidad_nacimiento_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function informacionProcedencia()
    {
        return $this->belongsTo(InformacionProcedencia::class, 'informacion_procedencia_id');
    }

    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'domicilio_id');
    }

    public function getIsAspiranteExternoAttribute()
    {
        return $this->alumno_id ? false : true;
    }
}
