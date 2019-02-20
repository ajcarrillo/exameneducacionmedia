<?php

namespace MediaSuperior\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use ExamenEducacionMedia\Http\Controllers\Controller;

class FiltrarPlantelesController extends Controller
{

    public function filtrar(Request $request)
    {
        if (Input::has('percent'))
        {
            var_dump("hey");exit;
        }
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
                                )*100)),0) = '.$request->only(['porcentaje' ]);
        $plantelescomplet = DB::select($filtro);
        return view('administracion.home', compact('plantelescomplet'));

    }

}
