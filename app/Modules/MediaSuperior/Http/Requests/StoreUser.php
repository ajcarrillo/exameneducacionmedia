<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-28
 * Time: 22:43
 */

namespace MediaSuperior\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUser extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'          => 'required',
            'primer_apellido' => 'required',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required',
            'roles'           => 'required',
            'roles.*'         => Rule::in([ 'cordinador', 'departamento', 'subsistema', 'plantel', 'aspirante' ]),
        ];
    }
}
