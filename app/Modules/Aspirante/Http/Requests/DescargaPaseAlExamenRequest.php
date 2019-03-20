<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-19
 * Time: 19:18
 */

namespace Aspirante\Http\Requests;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class DescargaPaseAlExamenRequest extends FormRequest
{

    public function authorize()
    {
        $aspirante = get_aspirante();
        return $aspirante->id == request('id');
    }

    public function rules()
    {
        return [];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('No tienes permisos para descargar el pase al examen de otro aspirante.');
    }
}
