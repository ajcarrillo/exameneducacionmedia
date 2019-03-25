<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-21
 * Time: 21:15
 */

namespace ExamenEducacionMedia\Exports;


use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Subsistema\Repositories\OfertaEducativaRepository;

class OfertaEducativaExports implements FromQuery, WithHeadings
{

    use Exportable;

    private $ofertas;
    private $plantelId;
    private $subsistemaId;
    private $incluirInactivos = false;
    private $params           = [];

    public function __construct(OfertaEducativaRepository $ofertas)
    {
        $this->ofertas = $ofertas;
    }

    public function params(array $params = [])
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'municipio',
            'localidad',
            'plantel',
            'subsistema',
            'especialidad',
            'alumos_por_grupo',
            'grupos',
            'total',
            'plantel_activo',
            'oferta_activa',
        ];
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->ofertas->all($this->params);
    }
}
