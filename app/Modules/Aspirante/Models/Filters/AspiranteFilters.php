<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-27
 * Time: 00:02
 */

namespace Aspirante\Models\Filters;


use DB;
use ExamenEducacionMedia\QueryFilter;

class AspiranteFilters extends QueryFilter
{

    public function rules(): array
    {
        return [
            'search' => 'filled|min:6',
        ];
    }

    public function search($query, $search)
    {
        $query->where('aspirantes.folio', 'like', "%{$search}%")
            ->orWhere('aspirantes.curp', 'like', "%{$search}%")
            ->orWhere('aspirantes.matricula', 'like', "%{$search}%")
            ->orWhere('users.email', 'like', "%{$search}%")
            ->orWhere(DB::raw("concat_ws(' ', nombre, primer_apellido, segundo_apellido)"), 'like', "%{$search}%");
    }


}
