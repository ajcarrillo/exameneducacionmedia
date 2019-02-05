<?php
/**
 * Created by PhpStorm.
 * User: Mini
 * Date: 31/01/2019
 * Time: 11:25 PM
 */

namespace MediaSuperior\Models;
use Illuminate\Database\Eloquent\Model;


class Archivo extends Model
{
    protected $table = 'archivos_descargables';
    protected $fillable = ['nombre','path','usuario_id' ];

    public function archivoRoles()
    {
        return $this->hasMany(ArchivoRoles::class, 'archivo_id');
    }

}