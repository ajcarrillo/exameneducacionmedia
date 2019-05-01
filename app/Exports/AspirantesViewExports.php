<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-05-01
 * Time: 13:40
 */

namespace ExamenEducacionMedia\Exports;

use Aspirante\Repositories\AspiranteRepository;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AspirantesViewExports implements FromView
{
    private $aspiranteRepository;

    public function __construct(AspiranteRepository $aspiranteRepository)
    {
        $this->aspiranteRepository = $aspiranteRepository;
    }

    public function view(): View
    {
        if (get_user()->hasRole('plantel')) {
            return view('exports.aspirantes', [
                'aspirantes' => DB::select($this->aspiranteRepository->listadoAspirantesPorPlantel(), [ get_user()->plantel->id ]),
            ]);
        } else {
            return view('exports.aspirantes', [
                'aspirantes' => DB::select($this->aspiranteRepository->listadoAspirantesPorSubsistema(), [ get_user()->subsistema->id ]),
            ]);
        }
    }
}
