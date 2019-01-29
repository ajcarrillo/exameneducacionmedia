<?php

namespace MediaSuperior\Http\Controllers\Administracion\Revisiones;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Subsistema\Models\OfertaEducativa;
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
        $revisiones = array();
        $subsistemas = Subsistema::select('id',DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');
        return view('media_superior.administracion.ofertaEducativa.index', compact('subsistemas', 'revisiones'));
    }

    public function oferta(Request $request)
    {
        $estado = $request->get('estado') ?? '';
        $subsistema_id = $request->get('subsistema_id') ?? '';
        $revisiones = array();

        if(!empty($estado)){
            $revisiones = RevisionOferta::with(['review'=>function($query) use ($request) {
                return $query->where('estado', $request->get('estado'));
            }, 'subsistema','review.usuarioApertura','review.usuarioRevision'])->get();
        }

        if(!empty($subsistema_id)){
            $revisiones = RevisionOferta::with(['review','subsistema','review.usuarioApertura','review.usuarioRevision'])
                ->where('revision_ofertas.subsistema_id','=',$subsistema_id)
                ->get();
        }

        $subsistemas = Subsistema::select('id',DB::raw('referencia'))
            ->orderBy('id', 'asc')
            ->get()->pluck('referencia', 'id');

        return view('media_superior.administracion.ofertaEducativa.index', compact('subsistemas', 'revisiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}