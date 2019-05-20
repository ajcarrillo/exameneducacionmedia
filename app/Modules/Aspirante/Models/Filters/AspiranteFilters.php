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
            'search'         => 'filled|min:6',
            'plantel'        => 'filled',
            'subsistema'     => 'filled',
            'conpagosinpase' => 'present',
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

    public function conpagosinpase($query, $conpagosinpase)
    {
        $query->join('revision_registros', function ($join) {
            $join->on('aspirantes.id', 'revision_registros.aspirante_id')
                ->where('revision_registros.efectuado', 1);
        })->leftJoin('pases_examen', function ($join) {
            $join->on('revision_registros.aspirante_id', 'pases_examen.aspirante_id');
        })->whereNull('pases_examen.aspirante_id');
    }

    public function plantel($query, $plantel)
    {
        $query->where('planteles.id', $plantel);
    }

    public function subsistema($query, $subsitema)
    {
        $query->where('planteles.subsistema_id', $subsitema);
    }


}
