<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-20
 * Time: 11:23
 */

namespace MediaSuperior\Models;


use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{

    protected $connection   = 'geo_db';
    protected $table        = 'geodatabase.mun_loc_qroo_camp';

}
