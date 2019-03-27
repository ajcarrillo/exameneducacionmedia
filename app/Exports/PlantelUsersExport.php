<?php

namespace ExamenEducacionMedia\Exports;

use ExamenEducacionMedia\UserRepository;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantelUsersExport implements FromQuery, WithHeadings
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'plantel',
            'municipio',
            'subsistema',
            'nombre',
            'usuario',
        ];
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->repository->usuariosPlanteles();
    }
}
