<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-09
 * Time: 01:56
 */

namespace ExamenEducacionMedia\Contracts;


interface ProviderInterface
{
    public function enviar();

    public static function verificarPago($solicitudId);

    public static function getFichaPago($solicitudId);
}
