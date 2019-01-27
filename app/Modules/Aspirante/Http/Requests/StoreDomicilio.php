<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-24
 * Time: 20:01
 */

namespace Aspirante\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreDomicilio extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cve_ent' => 'required',
            'cve_mun' => 'required',
            'cve_loc' => 'required',
            'colonia' => 'required',
            'calle'   => 'required',
            'numero'  => 'required',
        ];
    }
}
