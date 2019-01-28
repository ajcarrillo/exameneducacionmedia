<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 10:40
 */

namespace Aspirante\Http\Requests;


use Aspirante\Rules\FechaNacimiento;
use Illuminate\Foundation\Http\FormRequest;

class StoreAspiranteConMatricula extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'sexo'             => 'in:H,M',
            'email'            => 'required|email|unique:users',
            'nombre'           => 'required',
            'alumno_id'        => 'required|unique:aspirantes',
            'primer_apellido'  => 'required',
            'fecha_nacimiento' => [ new FechaNacimiento, ],
        ];
    }

}
