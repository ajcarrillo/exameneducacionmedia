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

class Grupo extends Model
{
    use Compoships;

    protected $table    = 'oferta_educativa_grupos';
    protected $fillable = [
        'grupos',
        'alumnos',
        'oferta_educativa_id',
    ];

    public function ofertaEducativa()
    {
        return $this->belongsTo(OfertaEducativa::class, 'oferta_educativa_id');
    }
}
