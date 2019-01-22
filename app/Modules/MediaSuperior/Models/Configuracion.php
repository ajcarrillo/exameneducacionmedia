<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-21
 * Time: 21:08
 */

namespace MediaSuperior\Models;


use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';

    public static function edadMinima()
    {
        return Configuracion::getConfiguracion('Edad minima');
    }

    protected static function getConfiguracion($descripcion)
    {
        return Configuracion::whereDescripcion($descripcion)->first();
    }

    public static function edadMaxima()
    {
        return Configuracion::getConfiguracion('Edad maxima');
    }
}
