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
            'role'   => 'filled|in:supermario,cordinador,departamento,subsistema,plantel,aspirante,invitado',
            'search' => 'filled',
            'curp'   => 'filled|min:4',
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

    public function curp($query, $curp)
    {
        return $query->whereHas('aspirante', function ($q) use ($curp) {
            return $q->where('curp', 'like', "%{$curp}%")
                ->orWhere('folio', 'like', "%{$curp}%");
        });
    }
}
