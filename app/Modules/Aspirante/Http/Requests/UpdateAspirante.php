<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 17:36
 */

namespace Aspirante\Http\Requests;


use Aspirante\Rules\FechaNacimiento;
use Aspirante\Traits\Utilities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAspirante extends FormRequest
{
    use Utilities;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'                => 'required',
            'primer_apellido'       => 'required',
            'telefono'              => 'required',
            'sexo'                  => 'required|in:H,M',
            'pais_nacimiento_id'    => 'required',
            'entidad_nacimiento_id' => 'required_if:pais_nacimiento_id,MX',
            'fecha_nacimiento'      => [
                'required',
                new FechaNacimiento,
            ],
            'curp'                  => [
                'required_if:pais_nacimiento_id,MX',
                'nullable',
                Rule::unique('aspirantes')->ignore($this->id),
            ],
            'curp_historica'        => 'required_with:curp',
            'curp_valida'           => 'required_with:curp',
        ];
    }
}
