<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-21
 * Time: 21:38
 */

namespace Aspirante\Rules;


use DateTime;
use Illuminate\Contracts\Validation\Rule;
use MediaSuperior\Models\Configuracion;

class FechaNacimiento implements Rule
{
    protected $edadMinima;
    protected $edadMaxima;

    public function __construct()
    {
        $this->edadMinima = Configuracion::edadMinima()->valor;
        $this->edadMaxima = Configuracion::edadMaxima()->valor;
    }

    public function passes($attribute, $value)
    {
        $from       = new DateTime($value);
        $to         = new DateTime('today');
        $age        = $from->diff($to)->y;
        $edadMinima = Configuracion::edadMinima()->valor;
        $edadMaxima = Configuracion::edadMaxima()->valor;

        return $age >= $edadMinima && $age <= $edadMaxima;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return "El proceso es para aspirantes de edades entre {$this->edadMinima} y {$this->edadMaxima} años";
    }
}
