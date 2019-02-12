<?php

namespace MediaSuperior\Http\Controllers\Administracion\Revisiones;


use ExamenEducacionMedia\Exports\UsersExport;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaSuperior\Models\Revision;
use Subsistema\Models\RevisionOferta;
use Subsistema\Models\Subsistema;
use DB;


class OfertaEducativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado      = '';
        $revisiones  = array();
        $subsistemas = Subsistema::select('id', DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');

        return view('media_superior.administracion.ofertaEducativa.index', compact('subsistemas', 'revisiones', 'estado'));
    }

    public function oferta(Request $request)
    {
        $estado        = $request->get('estado') ?? '';
        $subsistema_id = $request->get('subsistema_id') ?? '';
        $revisiones    = array();

        if ( ! empty($estado)) {
            /*$revisiones = RevisionOferta::with(['review'=>function($query) use ($request) {
                return $query->where('estado', $request->get('estado'));
            }, 'subsistema','review.usuarioApertura','review.usuarioRevision'])->get();*/

            $revisiones = Revision::where('estado', $request->get('estado'))
                ->where('revision_type', 'ofertas')
                ->with('revision', 'revision.subsistema', 'usuarioApertura', 'usuarioRevision')
                ->get();
        }

        if ( ! empty($subsistema_id)) {
            $revisiones = RevisionOferta::with([ 'review', 'subsistema', 'review.usuarioApertura', 'review.usuarioRevision' ])
                ->where('revision_ofertas.subsistema_id', '=', $subsistema_id)
                ->get();
        }

        $subsistemas = Subsistema::select('id', DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');

        return view('media_superior.administracion.ofertaEducativa.index', compact('subsistemas', 'revisiones', 'estado'));
    }

    public function guardarComentario(Request $request)
    {
        $id = $request->get('id');
        if ($request->get('estado') == 'C') {
            Revision::find($id)->update(
                [
                    'fecha_revision'   => now(),
                    'estado'           => $request->get('estado'),
                    'comentario'       => $request->get('comentario'),
                    'usuario_revision' => \Auth::user()->id,
                ]
            );
        } elseif ($request->get('estado') == 'A') {
            Revision::find($id)->update(
                [
                    'fecha_revision'   => now(),
                    'estado'           => $request->get('estado'),
                    'comentario'       => $request->get('comentario'),
                    'usuario_revision' => \Auth::user()->id,
                ]
            );
        }

        if ($request->get('estado') == 'C') {
            flash('La oferta educativa fue rechazada exitosamente')->success();
        } elseif ($request->get('estado') == 'A') {
            flash('La oferta educativa fue aceptada exitosamente')->success();
        }

        return redirect()->back();
    }

    public function imprimir(Request $request)
    {
        return \Excel::download(new UsersExport($request->get('subsistema_id'), $request->get('formato')), 'ofertaEducativa.csv');
    }
}