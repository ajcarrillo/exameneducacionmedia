<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio;
use Illuminate\Support\Facades\Input;
use MediaSuperior\Models\Revision;
use ExamenEducacionMedia\Models\EtapaProceso;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;
use Subsistema\Models\RevisionOferta;
use Subsistema\Models\Subsistema;
use Illuminate\Http\JsonResponse;

class PanelController extends Controller
{
    public function index()
    {
        $activar = 1;
        switch (EtapaProceso::isAforo()){
            case true:
                $activar = 0;
                break;
        }

        switch (EtapaProceso::isRegistro()){
            case true:
                $activar = 0;
                break;
        }

        switch (EtapaProceso::isOferta()){
            case true:
                $activar = 0;
                break;
        }

        $usuario_id = Auth::user()->id;
        $vari= Subsistema::with('responsable')->where('responsable_id', $usuario_id)->get();
        foreach ($vari as $r) {
            $subsistema_id = $r->id;
        }
        //Datos generales
        $especialidades= OfertaEducativa::with('activar')->where('active', 1)->count('especialidad_id');
        $planteles = Plantel::where('active', 1)->count('id');
        $hoy = date("Y-m-d");
        $aspirantes_hoy= Aspirante::where('created_at', 'LIKE', '%'. $hoy.'%')->count('id');
        $total_aspirantes = Aspirante::count('id');
        $revisiones_oferta = Revision::where('estado','R')
            ->where('revision_type', 'ofertas')
            ->where('ro.subsistema_id',$subsistema_id)
            ->join('revision_ofertas as ro', 'ro.id', '=', 'revisiones.revision_id')
            ->with('revision', 'revision.subsistema','revision.revisionOferta', 'usuarioApertura', 'usuarioRevision')
            ->count('revision_id');
        $revisiones_aforo = Revision::where('estado','R')
            ->where('revision_type', 'aforos')
            ->where('ro.subsistema_id',$subsistema_id)
            ->join('revision_ofertas as ro', 'ro.id', '=', 'revisiones.revision_id')
            ->with('revision', 'revision.subsistema','revision.revisionOferta', 'usuarioApertura', 'usuarioRevision')
            ->count('revision_id');
        $total_folios= Folio::where('active', 1)->count('id');
        $folios_usados = Aspirante::count('folio');
        $porcentaje_folios = ($folios_usados / $total_folios) * 100;

        //consulta fechas y personas por dia para la grafica
        $f= Aspirante::select(DB::raw('DISTINCT(DATE_FORMAT(created_at, "%Y-%m-%d")) as fecha'))
            ->groupBy('id')
            ->pluck('fecha');
        $fechas_r = $f;
        $dato= Aspirante::select(DB::raw('DISTINCT(DATE_FORMAT(created_at, "%Y-%m-%d")) as fecha, count(id) as personas_por_dia'))
            ->groupBy('fecha')
            ->pluck('personas_por_dia');


        // consulta los planteles con demanda
        $plnt = 'select sb.referencia, t.*,
                    (SELECT COUNT(of.id) 
                                FROM ofertas_educativas as of
                                WHERE of.plantel_id = t.id and of.active = 1
                                ) as ofertas,
                    (SELECT COUNT(DISTINCT(sel.aspirante_id)) 
                                FROM seleccion_ofertas_educativas as sel
                                INNER JOIN ofertas_educativas as oe on oe.id = sel.oferta_educativa_id
                                WHERE oe.plantel_id = t.id 
                                ) as demanda,                                
                    IFNULL((SELECT SUM(au.capacidad) 
                                FROM aulas as au
                                WHERE au.edificio_type= "plantel" and au.edificio_id = t.id
                                ),0) as capacidad_aula,
                    IFNULL((ROUND((SELECT COUNT(DISTINCT(pe.aspirante_id)) 
                                FROM pases_examen as pe
                                INNER JOIN seleccion_ofertas_educativas as sof on sof.aspirante_id = pe.aspirante_id
                                INNER JOIN ofertas_educativas as oe on oe.id = sof.oferta_educativa_id
                                WHERE oe.plantel_id = t.id 
                                )/(SELECT SUM(au.capacidad) 
                                FROM aulas as au
                                WHERE au.edificio_type= "plantel" and au.edificio_id = t.id
                                )*100)),0)as porcentaje
                    from planteles as t
                    inner join subsistemas as sb on sb.id = t.subsistema_id 
                    where t.active = 1';
        $plantelescomplet = DB::select($plnt);

        //consulta para el filtro
        $porcentaje_f = 'select DISTINCT
                    IFNULL((ROUND((SELECT COUNT(DISTINCT(pe.aspirante_id)) 
                                FROM pases_examen as pe
                                INNER JOIN seleccion_ofertas_educativas as sof on sof.aspirante_id = pe.aspirante_id
                                INNER JOIN ofertas_educativas as oe on oe.id = sof.oferta_educativa_id
                                WHERE oe.plantel_id = t.id 
                                )/(SELECT SUM(au.capacidad) 
                                FROM aulas as au
                                WHERE au.edificio_type= "plantel" and au.edificio_id = t.id
                                )*100)),0)as porcentaje
                    from planteles as t
                    inner join subsistemas as sb on sb.id = t.subsistema_id 
                    where t.active = 1';
        $porcentaje_filtro = DB::select($porcentaje_f);
        if ((Input::has('percent')))
        {
            if(((Input::get('percent'))== NULL)){

            }else{
            $filtro = 'select sb.referencia, t.*,
                    (SELECT COUNT(of.id) 
                                FROM ofertas_educativas as of
                                WHERE of.plantel_id = t.id and of.active = 1
                                ) as ofertas,
                    (SELECT COUNT(DISTINCT(sel.aspirante_id)) 
                                FROM seleccion_ofertas_educativas as sel
                                INNER JOIN ofertas_educativas as oe on oe.id = sel.oferta_educativa_id
                                WHERE oe.plantel_id = t.id 
                                ) as demanda,                                
                    IFNULL((SELECT SUM(au.capacidad) 
                                FROM aulas as au
                                WHERE au.edificio_type= "plantel" and au.edificio_id = t.id
                                ),0) as capacidad_aula,
                    IFNULL((ROUND((SELECT COUNT(DISTINCT(pe.aspirante_id)) 
                                FROM pases_examen as pe
                                INNER JOIN seleccion_ofertas_educativas as sof on sof.aspirante_id = pe.aspirante_id
                                INNER JOIN ofertas_educativas as oe on oe.id = sof.oferta_educativa_id
                                WHERE oe.plantel_id = t.id 
                                )/(SELECT SUM(au.capacidad) 
                                FROM aulas as au
                                WHERE au.edificio_type= "plantel" and au.edificio_id = t.id
                                )*100)),0)as porcentaje
                    from planteles as t
                    inner join subsistemas as sb on sb.id = t.subsistema_id 
                    where t.active = 1 AND 

IFNULL((ROUND((SELECT COUNT(DISTINCT(pe.aspirante_id)) 
                                FROM pases_examen as pe
                                INNER JOIN seleccion_ofertas_educativas as sof on sof.aspirante_id = pe.aspirante_id
                                INNER JOIN ofertas_educativas as oe on oe.id = sof.oferta_educativa_id
                                WHERE oe.plantel_id = t.id 
                                )/(SELECT SUM(au.capacidad) 
                                FROM aulas as au
                                WHERE au.edificio_type= "plantel" and au.edificio_id = t.id
                                )*100)),0) = '.Input::get('percent');
            $plantelescomplet = DB::select($filtro);
            }
        }

        return view('administracion.home', compact('especialidades','planteles','activar','aspirantes_hoy','total_aspirantes','revisiones_oferta',
            'revisiones_aforo','total_folios', 'folios_usados', 'porcentaje_folios','fechas_r','plantelescomplet','porcentaje_filtro','dato'));
    }

    public function cancelarOferta()
    {
        try {
            $ofertas = OfertaEducativa::all();
            $ofertas->map(function ($oferta){
                $oferta->desactivar();
            });
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
                ->update(['active' => 0]);

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

    }
}
