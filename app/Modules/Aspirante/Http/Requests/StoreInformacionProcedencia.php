<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 21:46
 */

namespace Aspirante\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreInformacionProcedencia extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_centro_trabajo' => 'required',
            'turno_id'              => 'required',
            'fecha_egreso'          => 'required',
            'primera_vez'           => 'required',
        ];
    }
}
