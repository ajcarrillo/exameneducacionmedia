<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 10:40
 */

namespace Aspirante\Http\Requests;


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
            'sexo'                  => 'in:H,M',
            'entidad_nacimiento_id' => 'required',
            'alumno_id'             => 'required',
            'nombre'                => 'required',
            'primer_apellido'       => 'required',
            'email'                 => 'required|email|unique:users',
        ];
    }

}
