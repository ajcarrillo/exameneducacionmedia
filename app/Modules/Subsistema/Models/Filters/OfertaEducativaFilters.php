<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-22
 * Time: 00:35
 */

namespace Subsistema\Models\Filters;


use ExamenEducacionMedia\QueryFilter;

class OfertaEducativaFilters extends QueryFilter
{

    public function rules(): array
    {
        return [
            'subsistema' => 'filled',
            'plantel'    => 'filled',
        ];
    }

    public function subsistema($query, $subsistema)
    {
        $query->where('s.id', $subsistema);
    }

    public function plantel($query, $plantel)
    {
        $query->where('p.id', $plantel);
    }
}
