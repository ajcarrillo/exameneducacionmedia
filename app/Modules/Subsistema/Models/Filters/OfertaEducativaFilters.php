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
            'inactivos'  => 'filled',
            'municipio'  => 'filled',
        ];
    }

    public function municipio($query, $municipio)
    {
        $query->where('geo.CVE_ENT', 23)->where('geo.CVE_MUN', $municipio);
    }

    public function subsistema($query, $subsistema)
    {
        $query->where('s.id', $subsistema);
    }

    public function plantel($query, $plantel)
    {
        $query->where('p.id', $plantel);
    }

    public function inactivos($query, $inactivos)
    {
        if ( ! $inactivos) {
            $query->where('p.active', 1)->where('ofertas_educativas.active', 1);
        }
    }
}
