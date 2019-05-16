<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-05-16
 * Time: 15:19
 */

namespace ExamenEducacionMedia\Exports;


use Aspirante\Repositories\AspiranteRepository;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ListadoGeneralSMLPViewExports implements FromView
{
    private $aspiranteRepository;

    public function __construct(AspiranteRepository $aspiranteRepository)
    {
        $this->aspiranteRepository = $aspiranteRepository;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('exports.rpt_genera_por_mun_sub_loc_plantel', [
            'aspirantes' => DB::select($this->aspiranteRepository->listadoGeneralPorMunSubLocPlantel()),
        ]);
    }
}
