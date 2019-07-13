<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-07-13
 * Time: 11:47
 */

namespace Aspirante\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Subsistema\Models\OfertaEducativa;

class Asignacion extends Model
{
    protected $table = 'asignaciones';

    public function aspirante(): BelongsTo
    {
        return $this->belongsTo(Aspirante::class, 'folio', 'folio');
    }

    public function ofertaEducativa(): BelongsTo
    {
        return $this->belongsTo(OfertaEducativa::class, 'oferta_educativa_id');
    }
}
