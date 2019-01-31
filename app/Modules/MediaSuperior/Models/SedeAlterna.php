<?php
/**
 * Created by PhpStorm.
 * User: wsanchez
 * Date: 29/01/2019
 * Time: 11:28 AM
 */

namespace ExamenEducacionMedia\Modules\MediaSuperior\Models;


use Illuminate\Database\Eloquent\Model;

class SedeAlterna extends Model
{
    protected $table    = 'enlaces';
    protected $fillable = [
        'descripcion', 'domicilio_id', 'plantel_id'
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