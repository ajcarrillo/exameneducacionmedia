<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-13
 * Time: 13:06
 */

namespace Subsistema\Models;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class OfertaEducativa extends Model
{
    use Compoships;

    protected $table    = 'ofertas_educativas';
    protected $fillable = [
        'plantel_id', 'especialidad_id', 'active',
        'clave', 'programa_estudio_id',
    ];

    public function plantel()
    {
        return $this->belongsTo(Plantel::class, 'plantel_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function programaEstudio()
    {
        return $this->belongsTo(ProgramaEstudio::class, 'programa_estudio_id');
    }

    public function grupos()
    {
        return $this->hasOne(Grupo::class, 'oferta_educativa_id');
    }

    public function activar()
    {
        $this->update([ 'active' => true ]);
    }

    public function desactivar()
    {
        $this->update([ 'active' => false ]);
    }

    public function scopeOnlyActive($query)
    {
        return $query->where('active', true);
    }
}
