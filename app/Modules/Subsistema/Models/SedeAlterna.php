<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 11:03
 */

namespace Subsistema\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\Models\Domicilio;
use Illuminate\Database\Eloquent\Model;

class SedeAlterna extends Model
{
    use Compoships;

    protected $table    = 'sedes_alternas';
    protected $fillable = [
        'descripcion', 'domicilio_id', 'plantel_id', 'sede_ceneval'
    ];


    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'domicilio_id');
    }

    public function plantel()
    {
        return $this->belongsTo(Plantel::class, 'plantel_id');
    }

    public function aulas()
    {
        return $this->morphMany(Aula::class, 'edificio');
    }
}
