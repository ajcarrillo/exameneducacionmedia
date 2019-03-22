<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-21
 * Time: 21:57
 */

namespace ExamenEducacionMedia\Classes;


abstract class BaseRepository
{
    public function newQuery()
    {
        return $this->getModel()->newQuery();
    }

    abstract public function getModel();
}
