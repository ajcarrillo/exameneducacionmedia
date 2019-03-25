<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-25
 * Time: 13:26
 */

namespace ExamenEducacionMedia\Http\Controllers;


use ExamenEducacionMedia\Exports\OfertaEducativaExports;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Subsistema\Models\Filters\OfertaEducativaFilters;
use Subsistema\Models\Subsistema;
use Subsistema\Repositories\OfertaEducativaRepository;

class ReporteController extends Controller
{
    private $repository;

    public function __construct(OfertaEducativaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $reportes    = $this->reportes();
        $userRoles   = get_user_roles();
        $subsistemas = Subsistema::getSubsistemas();
        $municipios  = MunicipioView::getMunicipios();

        return view('reportes.index', compact('reportes', 'userRoles', 'municipios', 'subsistemas'));
    }

    public function oferta(Request $request, Excel $excel, OfertaEducativaExports $export)
    {
        dump($request->only([ 'municipio', 'subsistema', 'inactivos' ]));

        return $excel->download($export->params($request->only([ 'municipio', 'subsistema', 'inactivos' ])), 'ofertas.xlsx');
    }

    protected function reportes(): array
    {
        return [
            'oferta' => [
                'descripcion' => 'Oferta educativa',
                'roles'       => [ 'departamento', 'subsistema', 'plantel' ],
                'url'         => route('reportes.oferta'),
            ],
            /*'aforo'  => [
                'descripcion' => 'Aforo',
                'roles'       => [ 'departamento', 'subsistema', 'plantel' ],
                'url'         => '',
            ],*/
        ];
    }
}
