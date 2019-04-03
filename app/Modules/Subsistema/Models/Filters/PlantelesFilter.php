<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-08
 * Time: 18:54
 */

namespace Subsistema\Models\Filters;


use ExamenEducacionMedia\QueryFilter;

class PlantelesFilter extends QueryFilter
{

    public function rules(): array
    {
        return [
            'subsistema' => 'filled',
            'search'     => 'filled',
            'plantel'    => 'filled',
        ];
    }

    public function subsistema($query, $subsistema)
    {
        return $query->where('planteles.subsistema_id', $subsistema);
    }

    public function search($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('descripcion', 'like', "%{$search}%")
                ->orWhere('clave', 'like', "%{$search}%");
        });
    }
}
