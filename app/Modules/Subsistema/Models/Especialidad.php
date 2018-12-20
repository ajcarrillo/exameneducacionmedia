<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-19
 * Time: 23:57
 */

namespace Subsistema\Models;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use Compoships;

    protected $table = 'especialidades';

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class, 'subsistema_id');
    }
}
