<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-13
 * Time: 13:08
 */

namespace ExamenEducacionMedia\Modules\Subsistema\Models;


use Illuminate\Database\Eloquent\Model;
use Subsistema\Models\OfertaEducativa;

class ProgramaEstudio extends Model
{
    protected $table   = 'programas_estudio';
    protected $guarded = [];

    public function ofertaEducativa()
    {
        return $this->hasMany(OfertaEducativa::class, 'programa_estudio_id');
    }

}
