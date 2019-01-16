<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 22:52
 */

namespace ExamenEducacionMedia\Models\Geodatabase;


use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $connection   = 'geo_db';
    protected $table        = 'paises';
    protected $primaryKey   = NULL;
    public    $incrementing = NULL;

    public static function selectPaises()
    {
        return Pais::select('id', 'descripcion')
            ->orderBy('descripcion')
            ->get();
    }
}
