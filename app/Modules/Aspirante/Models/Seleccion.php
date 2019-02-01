<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-27
 * Time: 17:07
 */

namespace Aspirante\Models;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Subsistema\Models\OfertaEducativa;

class Seleccion extends Model
{
    use Compoships;

    protected $table    = 'seleccion_ofertas_educativas';
    protected $fillable = [
        'preferencia', 'aspirante_id', 'oferta_educativa_id',
    ];

    public function aspirante()
    {
        return $this->belongsTo(Aspirante::class, 'aspirante_id');
    }

    public function ofertaEducativa()
    {
        return $this->belongsTo(OfertaEducativa::class, 'oferta_educativa_id');
    }
}
