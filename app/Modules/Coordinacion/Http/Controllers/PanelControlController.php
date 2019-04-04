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
        $planteles                = $this->plantelRepository->estadisticasPlantel()->get();
        $topTen                   = $planteles->sortByDesc('porcentaje')->take(10);
        $subsistemasDemandaOferta = $this->subsistemaRepository->ofertaDemanda();
        $aspirantes               = $this->aspirantes();
        $oferta                   = $this->oferta();
        $demanda                  = $this->demanda();
        $pases                    = $this->paseAlExamen();
        $sinPase                  = $this->sinPaseAlExamen();
        $sexos                    = $this->getSexos();

        return view('coordinacion.index', compact(
            'aspirantes',
            'oferta',
            'demanda',
            'pases',
            'sinPase',
            'topTen',
            'subsistemasDemandaOferta',
            'sexos'
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

    /**
     * @return array|\Illuminate\Support\Collection
     */
    protected function getSexos()
    {
        $aspirantesSexo = DB::table('aspirantes')
            ->select(DB::raw('sexo, count(sexo) as total'))
            ->groupBy('sexo')
            ->whereNotNull('sexo')
            ->get();

        $aspirantesSexoCurp = DB::table('aspirantes')
            ->select(DB::raw('substring(curp, 11, 1) sexo, count(substring(curp, 11, 1)) total'))
            ->whereNull('sexo')
            ->whereNotNull('curp')
            ->groupBy(DB::raw('substring(curp, 11, 1)'))
            ->get();

        $sexos = [
            [
                'sexo'  => 'H',
                'total' => $aspirantesSexo[0]->total + $aspirantesSexoCurp[0]->total,
            ],
            [
                'sexo'  => 'M',
                'total' => $aspirantesSexo[1]->total + $aspirantesSexoCurp[1]->total,
            ],
        ];

        $sexos = collect($sexos);

        return $sexos;
    }
}
