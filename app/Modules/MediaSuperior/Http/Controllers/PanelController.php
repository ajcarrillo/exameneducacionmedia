<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\EtapaProceso;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;
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
        $especialidades= OfertaEducativa::with('activar')->where('active', 1)->count('especialidad_id');
        $planteles = Plantel::where('active', 1)->count('id');
        $hoy = date("Y-m-d");
        $aspirantes_hoy= Aspirante::where('created_at', 'LIKE', '%'. $hoy.'%')->count('id');
        return view('administracion.home', compact('especialidades','planteles', 'activar'));
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
