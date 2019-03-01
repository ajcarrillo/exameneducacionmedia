<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-01
 * Time: 01:42
 */

namespace MediaSuperior\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'           => 'required',
            'primer_apellido'  => 'required',
            'segundo_apellido' => 'nullable',
            'email'            => [
                'required',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'roles'            => 'required',
            'roles.*'          => Rule::in([ 'cordinador', 'departamento', 'subsistema', 'plantel' ]),
        ];
    }
}
