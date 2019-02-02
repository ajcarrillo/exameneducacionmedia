<?php

namespace MediaSuperior\Http\Controllers\Administracion\Revisiones;


use ExamenEducacionMedia\Exports\UsersExport;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaSuperior\Models\Revision;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\RevisionOferta;
use Subsistema\Models\Subsistema;
use DB;
use Maatwebsite\Excel;


class OfertaEducativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado = '';
        $revisiones = array();
        $subsistemas = Subsistema::select('id',DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');
        return view('media_superior.administracion.ofertaEducativa.index', compact('subsistemas', 'revisiones', 'estado'));
    }

    public function oferta(Request $request)
    {
        $estado = $request->get('estado') ?? '';
        $subsistema_id = $request->get('subsistema_id') ?? '';
        $revisiones = array();

        if(!empty($estado)){
            /*$revisiones = RevisionOferta::with(['review'=>function($query) use ($request) {
                return $query->where('estado', $request->get('estado'));
            }, 'subsistema','review.usuarioApertura','review.usuarioRevision'])->get();*/

            $revisiones = Revision::where('estado',$request->get('estado'))->with('revision','revision.subsistema','usuarioApertura','usuarioRevision')->get();
        }

        if(!empty($subsistema_id)){
            $revisiones = RevisionOferta::with(['review','subsistema','review.usuarioApertura','review.usuarioRevision'])
                ->where('revision_ofertas.subsistema_id','=',$subsistema_id)
                ->get();
        }

        $subsistemas = Subsistema::select('id',DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');

        return view('media_superior.administracion.ofertaEducativa.index', compact('subsistemas', 'revisiones', 'estado'));
    }

    public function guardarComentario(Request $request)
    {
        $id = $request->get('id');
        Revision::find($id)->update(
            [
                'estado' => 'C',
                'comentario' => $request->get('comentario'),
            ]
        );
        flash('Se rechazo la oferta educativa exitosamente')->success();
        return redirect()->back();
    }

    public function imprimir(Request $request)
    {
        return  \Excel::download( new UsersExport($request->get('subsistema_id')), 'ofertaEducativa.csv');
    }
}