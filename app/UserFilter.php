<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-31
 * Time: 18:59
 */

namespace ExamenEducacionMedia;


use DB;

class UserFilter extends QueryFilter
{

    public function rules(): array
    {
        return [
            'role'   => 'filled|in:subsistema,plantel,aspirante',
            'search' => 'filled',
        ];
    }

    public function search($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where(DB::raw("concat_ws(' ', nombre, primer_apellido, segundo_apellido)"), 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });
    }

    public function role($query, $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            return $q->where('name', $role);
        });
    }
}