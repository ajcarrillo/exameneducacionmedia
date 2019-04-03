<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
use Aspirante\Models\Pase;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\EtapaProceso;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use MediaSuperior\Models\Revision;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;
use Subsistema\Repositories\PlantelRepository;

class PanelController extends Controller
{
    /**
     * @var PlantelRepository
     */
    private $repository;

    public function __construct(PlantelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        //Datos generales
        $especialidades   = OfertaEducativa::onlyActive()->count();
        $planteles        = Plantel::where('active', 1)->count('id');
        $hoy              = date("Y-m-d");
        $aspirantes_hoy   = Aspirante::where('created_at', 'LIKE', '%' . $hoy . '%')->count('id');
        $total_aspirantes = Aspirante::count('id');

        $revisiones_oferta = Revision::where('estado', 'R')
            ->where('revision_type', 'ofertas')
            ->join('revision_ofertas as ro', 'ro.id', '=', 'revisiones.revision_id')
            ->with('revision', 'revision.subsistema', 'revision.revisionOferta', 'usuarioApertura', 'usuarioRevision')
            ->count('revision_id');

        $revisiones_aforo = Revision::where('estado', 'R')
            ->where('revision_type', 'aforos')
            ->join('revision_aforos as ro', 'ro.id', '=', 'revisiones.revision_id')
            ->with('revision', 'revision.subsistema', 'revision.revisionAforo', 'usuarioApertura', 'usuarioRevision')
            ->count('revision_id');

        $total_folios      = Folio::count();
        $folios_usados     = Aspirante::count('folio');
        $porcentaje_folios = $total_folios == 0 ? 0 : ($folios_usados / $total_folios) * 100;
        $pases_al_examen   = Pase::count();

        //consulta fechas y personas por dia para la grafica
        $fechas_r = Aspirante::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as fecha'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))
            ->pluck('fecha');

        $dato = Aspirante::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as fecha, count(id) as personas_por_dia'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
            ->pluck('personas_por_dia');

        $statsPlantel = $this->repository
            ->estadisticasPlantel()
            ->orderBy('planteles.descripcion')
            ->get();

        return view('administracion.home', compact('especialidades', 'planteles', 'aspirantes_hoy', 'total_aspirantes', 'revisiones_oferta',
            'revisiones_aforo', 'total_folios', 'folios_usados', 'porcentaje_folios', 'fechas_r', 'plantelescomplet', 'porcentaje_filtro', 'dato', 'statsPlantel', 'pases_al_examen'));
    }

    public function cancelarOferta()
    {
        try {
            OfertaEducativa::where('active', 1)
                ->update([ 'active' => 0 ]);
            /*$ofertas = OfertaEducativa::all();
            $ofertas->map(function ($oferta){
                $oferta->desactivar();
            });*/
            $data['meta'] = [
                'status'  => 'success',
                'message' => 'OK',
                'code'    => 200,
            ];
            //return redirect()->back();

        } catch (\Exception $e) {

            $data['meta'] = [
                'status'  => 'error',
                'message' => $e->getMessage(),
                'code'    => 500,
            ];
        }

        return new JsonResponse($data, $data['meta']['code'], [], 0);
    }

    public function desactivarPlanteles()
    {

        try {
            Plantel::where('active', 1)
                ->update([ 'active' => 0 ]);

            $data['meta'] = [
                'status'  => 'success',
                'message' => 'OK',
                'code'    => 200,
            ];
        } catch (ModelNotFoundException $exception) {
            $data['meta'] = [
                'status'  => 'error',
                'message' => $exception->getMessage(),
                'code'    => 500,
            ];
        }

        return new JsonResponse($data, $data['meta']['code'], [], 0);
    }
}
