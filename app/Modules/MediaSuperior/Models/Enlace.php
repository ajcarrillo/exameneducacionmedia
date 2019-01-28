<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-27
 * Time: 22:40
 */

namespace MediaSuperior\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    use Compoships;

    protected $table    = 'enlaces';
    protected $fillable = [
        'cve_ent', 'cve_mun', 'fecha_inicio', 'fecha_fin',
        'hora_inicio', 'hora_fin', 'domicilio', 'telefono',
    ];
    protected $appends  = [
        'fechas', 'horarios',
    ];

    public function municipio()
    {
        return $this->belongsTo(MunicipioView::class, [ 'cve_ent', 'cve_mun' ], [ 'CVE_ENT', 'CVE_MUN' ]);
    }

    public function getFechasAttribute()
    {
        return "Del {$this->fecha_inicio} al {$this->fecha_fin}";
    }

    public function getHorariosAttribute()
    {
        return "De {$this->hora_inicio} a {$this->hora_fin}";
    }
}
