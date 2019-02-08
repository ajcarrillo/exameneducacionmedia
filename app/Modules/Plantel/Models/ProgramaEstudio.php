<?php


namespace Plantel\Models;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class ProgramaEstudio extends Model
{
    use Compoships;

    protected $table   = 'programas_estudio';
    protected $guarded = [];

    public function ofertaEducativa()
    {
        return $this->hasMany(OfertaEducativa::class, 'programa_estudio_id');
    }

}
