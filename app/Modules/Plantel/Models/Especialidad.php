<?php


namespace Plantel\Models;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use Compoships;

    protected $table    = 'especialidades';
    protected $fillable = [ 'referencia', 'descripcion' ];

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class, 'subsistema_id');
    }
}
