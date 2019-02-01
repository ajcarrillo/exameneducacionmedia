<?php
/**
 * Created by PhpStorm.
 * User: Miguel Protonotario
 * Date: 2019-01-31
 * Time: 13:06
 */

namespace Subsistema\Models;


use Awobaz\Compoships\Compoships;
//use ExamenEducacionMedia\Modules\Subsistema\Models\ProgramaEstudio;
use Illuminate\Database\Eloquent\Model;

class SeleccionOfertaEducativa extends Model
{
    use Compoships;

    protected $table    = 'seleccion_ofertas_educativas';
    protected $fillable = [
        'preferencia', 'aspirante_id', 'oferta_educativa_id',
    ];

    public function ofertaEducativa()
    {
        return $this->belongsTo(OfertaEducativa::class, 'oferta_educativa_id')->with('especialidad','plantel');
    }




}
