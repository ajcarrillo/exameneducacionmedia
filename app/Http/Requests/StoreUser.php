<?php

namespace ExamenEducacionMedia\Http\Requests;

use Aspirante\Rules\FechaNacimiento;
use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'           => 'required',
            'primer_apellido'  => 'required',
            'email'            => 'required|email|unique:users',
            'fecha_nacimiento' => [ 'required', new FechaNacimiento ],
        ];
    }
}
