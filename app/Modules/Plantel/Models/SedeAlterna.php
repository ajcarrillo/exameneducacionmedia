<?php


namespace Plantel\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\Models\Domicilio;
use Illuminate\Database\Eloquent\Model;

class SedeAlterna extends Model
{
    use Compoships;

    protected $table    = 'sedes_alternas';
    protected $fillable = [
        'descripcion', 'sede_ceneval',
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
