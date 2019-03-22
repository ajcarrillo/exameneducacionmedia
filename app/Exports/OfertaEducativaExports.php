<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-21
 * Time: 21:15
 */

namespace ExamenEducacionMedia\Exports;


use Subsistema\Repositories\OfertaEducativaRepository;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OfertaEducativaExports implements FromQuery, WithHeadings
{

    use Exportable;

    private $ofertas;
    private $plantelId;
    private $subsistemaId;

    public function __construct(OfertaEducativaRepository $ofertas)
    {
        $this->ofertas = $ofertas;
    }

    public function forPlantel(int $plantel)
    {
        $this->plantelId = $plantel;

        return $this;
    }

    public function forSubsistema(int $subsistema)
    {
        $this->subsistemaId = $subsistema;

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
        ];
    }

    /**
     * @return Builder
     */
    public function query()
    {
        $subsistema = $this->subsistemaId;
        $plantel    = $this->plantelId;

        return $this->ofertas->all(compact('subsistema', 'plantel'));
    }
}
