<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-22
 * Time: 00:33
 */

namespace ExamenEducacionMedia\Traits;


use ExamenEducacionMedia\QueryFilter;

trait FilterByTrait
{
    public function scopeFilterBy($query, QueryFilter $filters, array $data)
    {
        return $filters->applyTo($query, $data);
    }
}
