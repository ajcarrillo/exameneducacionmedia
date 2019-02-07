<?php
/**
 * Created by PhpStorm.
 * User: alvaro
 * Date: 05/02/2019
 * Time: 04:35 PM
 */

namespace MediaSuperior\Http\Controllers\Administracion\Revisiones;

use ExamenEducacionMedia\Exports\UsersExport;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Modules\Subsistema\Models\RevisionAforo;
use Subsistema\Models\Subsistema;
use DB;
use Illuminate\Http\Request;
use MediaSuperior\Models\Revision;


class AforoController extends controller
{
    public function index()
    {
        $estado = '';
        $revisiones = array();
        $subsistemas = Subsistema::select('id',DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');
        return view('media_superior.administracion.aforo.index', compact('subsistemas', 'revisiones', 'estado'));
    }

    public function aforo(Request $request)
    {
        $estado = $request->get('estado') ?? '';
        $subsistema_id = $request->get('subsistema_id') ?? '';
        $revisiones = array();

        if(!empty($estado)){
            $revisiones = Revision::where('estado',$request->get('estado'))
                ->where('revision_type','aforos')
                ->with('revision','revision.subsistema','usuarioApertura','usuarioRevision')->get();
        }

        if(!empty($subsistema_id)){
            $revisiones = RevisionAforo::with('review','subsistema','review.usuarioApertura','review.usuarioRevision')
                ->where('revision_aforos.subsistema_id','=',$subsistema_id)
                ->get();
        }

        $subsistemas = Subsistema::select('id',DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');

        return view('media_superior.administracion.aforo.index', compact('subsistemas', 'revisiones', 'estado'));
    }

    public function guardarComentario(Request $request)
    {
        $id = $request->get('id');
        Revision::find($id)->update(
            [
                'estado' => $request->get('estado'),
                'comentario' => $request->get('comentario'),
            ]
        );
        if($request->get('estado')=='C'){
            flash('El aforo fue rechazado exitosamente')->success();
        } elseif ($request->get('estado')=='A'){
            flash('El aforo fue aceptado exitosamente')->success();
        }
        return redirect()->back();
    }

    public function imprimir(Request $request)
    {
        return  \Excel::download( new UsersExport($request->get('subsistema_id'),$request->get('formato')), 'aforo.csv');
    }

}