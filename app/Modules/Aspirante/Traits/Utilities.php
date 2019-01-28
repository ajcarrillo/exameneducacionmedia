<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 17:28
 */

namespace Aspirante\Traits;


use Aspirante\Models\Aspirante;

trait Utilities
{
    public function getAspiranteByUuid($id): Aspirante
    {
        return Aspirante::findOrFail($id);
    }
}
