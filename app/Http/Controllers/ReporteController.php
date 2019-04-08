<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-25
 * Time: 13:26
 */

namespace ExamenEducacionMedia\Http\Controllers;


use DB;
use ExamenEducacionMedia\Exports\OfertaEducativaExports;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Subsistema\Models\Subsistema;
use Subsistema\Models\Plantel;
use Subsistema\Repositories\OfertaEducativaRepository;
use Subsistema\Repositories\PlantelRepository;

class ReporteController extends Controller
{
    private $repository;
    private $plantelRepository;

    public function __construct(OfertaEducativaRepository $repository, PlantelRepository $plantelRepository)
    {
        $this->repository        = $repository;
        $this->plantelRepository = $plantelRepository;
    }

    public function index()
    {
        $reportes    = $this->reportes();
        $userRoles   = get_user_roles();
        $subsistemas = Subsistema::getSubsistemas();
        $municipios  = MunicipioView::getMunicipios();
        $planteles   = Plantel::getPlanteles();

        return view('reportes.index', compact('reportes', 'userRoles', 'municipios', 'subsistemas','planteles'));
    }

    public function oferta(Request $request, Excel $excel, OfertaEducativaExports $export)
    {
        return $excel->download($export->params($request->only([ 'municipio', 'subsistema', 'inactivos' ])), 'ofertas.xlsx');
    }

    public function reporteGeneralPorSubsistema()
    {
        $query = $this->plantelRepository->monitoreoPlanteles([])
            ->select(
                'subsistemas.id', 'subsistemas.referencia as subsistema',
                DB::raw('sum(proceso_completo) as proceso_completo'),
                DB::raw('sum(aspirantes_con_pago.con_pago) as con_pago'),
                DB::raw('sum(sin_registro) as sin_registro'),
                DB::raw('sum(aspirantes_con_registro_sin_pago.con_pago) as con_registro_sin_pago'),
                DB::raw('sum(demanda) as demanda'),
                DB::raw('sum(oferta) as oferta'),
                DB::raw('sum(aforo) as aforo')
            )
            ->groupBy('subsistemas.id')
            ->get();

        return $query;
    }

    protected function reportes(): array
    {
        return [
            'oferta'            => [
                'descripcion'  => 'Oferta educativa',
                'roles'        => [ 'departamento', 'subsistema', 'plantel' ],
                'url'          => route('reportes.oferta'),
                'show_filters' => true,
            ],
            'catalogo_opciones' => [
                'descripcion'  => 'Catálogo de opciones educativas',
                'roles'        => [ 'departamento', 'subsistema', 'plantel' ],
                'url'          => route('media.reporteOE'),
                'show_filters' => false,
            ]
            /*'aforo'  => [
                'descripcion' => 'Aforo',
                'roles'       => [ 'departamento', 'subsistema', 'plantel' ],
                'url'         => '',
            ],*/
        ];
    }
}
