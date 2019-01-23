<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 22:52
 */

namespace ExamenEducacionMedia\Models\Geodatabase;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use Compoships;

    protected $connection   = 'geo_db';
    protected $table        = 'paises';
    protected $primaryKey   = 'id';
    public    $incrementing = false;

    public static function selectPaises()
    {
        return Pais::select('id', 'descripcion')
            ->orderBy('descripcion')
            ->get();
    }
}
