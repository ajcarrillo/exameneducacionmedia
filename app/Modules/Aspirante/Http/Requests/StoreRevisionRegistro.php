<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-11
 * Time: 12:50
 */

namespace Aspirante\Http\Requests;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class StoreRevisionRegistro extends FormRequest
{
    public function authorize()
    {
        $aspirante = get_aspirante();

        return $aspirante->hasInformacionCompleta() ? true : false;
    }

    public function rules()
    {
        return [];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Revisa que toda tu información este completa.');
    }
}
