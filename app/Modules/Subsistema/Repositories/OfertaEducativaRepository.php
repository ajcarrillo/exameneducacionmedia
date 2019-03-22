<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-21
 * Time: 21:56
 */

namespace Subsistema\Repositories;


use DB;
use ExamenEducacionMedia\Classes\BaseRepository;
use Subsistema\Models\Filters\OfertaEducativaFilters;
use Subsistema\Models\OfertaEducativa;

class OfertaEducativaRepository extends BaseRepository
{

    public function getModel()
    {
        return new OfertaEducativa();
    }


    public function all(array $params)
    {
        $query = $this->newQuery()
            ->join('oferta_educativa_grupos as oeg', 'ofertas_educativas.id', '=', 'oeg.oferta_educativa_id')
            ->join('planteles as p', 'ofertas_educativas.plantel_id', '=', 'p.id')
            ->plantelConMunicipioLocalidad()
            ->join('subsistemas as s', 'p.subsistema_id', '=', 's.id')
            ->join('especialidades as e', 'ofertas_educativas.especialidad_id', '=', 'e.id')
            ->filterBy(new OfertaEducativaFilters, $params)
            ->where('p.active', 1)
            ->where('ofertas_educativas.active', 1)
            ->orderBy('subsistema')
            ->orderBy('municipio')
            ->orderBy('localidad')
            ->orderBy('plantel')
            ->orderBy('especialidad')
            ->selectRaw(
                'geo.NOM_MUN              municipio,
                geo.NOM_LOC              localidad,
                p.descripcion            plantel,
                s.referencia             subsistema,
                e.referencia             especialidad,
                oeg.alumnos              alumos_por_grupo,
                oeg.grupos               grupos,
                oeg.alumnos * oeg.grupos total'
            );

        return $query;
    }

    public function catalogoOpcionesEducativas()
    {
        $query = $this->all([]);
        $query->addSelect(
            DB::raw("UPPER(concat_ws(' ', p.calle_principal, 'ENTRE', p.calle_derecha, 'Y', p.calle_izquierda, 'colonia', p.colonia)) domicilio, p.telefono, p.pagina_web")
        );

        return $query;
    }
}
