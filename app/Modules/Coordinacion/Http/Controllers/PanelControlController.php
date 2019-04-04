<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-03
 * Time: 23:57
 */

namespace Coordinacion\Http\Controllers;


use Aspirante\Models\Aspirante;
use Aspirante\Models\Pase;
use Aspirante\Models\Seleccion;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\Grupo;
use Subsistema\Repositories\PlantelRepository;
use Subsistema\Repositories\SubsistemaRepository;

class PanelControlController extends Controller
{
    /**
     * @var PlantelRepository
     */
    private $plantelRepository;
    /**
     * @var SubsistemaRepository
     */
    private $subsistemaRepository;

    public function __construct(PlantelRepository $plantelRepository, SubsistemaRepository $subsistemaRepository)
    {
        $this->plantelRepository    = $plantelRepository;
        $this->subsistemaRepository = $subsistemaRepository;
    }

    public function __invoke()
    {
        $planteles = $this->plantelRepository->estadisticasPlantel()->get();

        $topTen                   = $planteles->sortByDesc('porcentaje')->take(10);
        $subsistemasDemandaOferta = $this->subsistemaRepository->ofertaDemanda();
        $aspirantes               = $this->aspirantes();
        $oferta                   = $this->oferta();
        $demanda                  = $this->demanda();
        $pases                    = $this->paseAlExamen();
        $sinPase                  = $this->sinPaseAlExamen();

        return view('coordinacion.index', compact(
            'aspirantes',
            'oferta',
            'demanda',
            'pases',
            'sinPase',
            'topTen',
            'subsistemasDemandaOferta'
        ));
    }

    protected function aspirantes()
    {
        return Aspirante::count();
    }

    protected function oferta()
    {
        return Grupo::sum(DB::raw('alumnos*grupos'));
    }

    protected function demanda()
    {
        return Seleccion::where('preferencia', 1)->count();
    }

    protected function paseAlExamen()
    {
        return Pase::count();
    }

    protected function sinPaseAlExamen()
    {
        return Aspirante::leftJoin('pases_examen', 'aspirantes.id', '=', 'pases_examen.aspirante_id')
            ->whereNull('pases_examen.id')
            ->count();
    }
}
