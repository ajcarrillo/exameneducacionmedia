<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\EtapaProceso;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;



class PanelController extends Controller
{
    public function index()
    {
        $usuario_id = Auth::user()->id;
        $especialidades= OfertaEducativa::with('activar')->where('active', 1)->count('especialidad_id');
        $planteles = Plantel::where('active', 1)->count('id');
        $hoy = date("Y-m-d");
        $aspirantes_hoy= Aspirante::where('created_at', 'LIKE', '%'. $hoy.'%')->count('id');

        $isAforo = EtapaProceso::isAforo();
        $isOferta = EtapaProceso::isOferta();
        $isRegistro = EtapaProceso::isRegistro();

        $botonDesactivar = true;
        if ($isAforo or $isOferta or $isRegistro)
            $botonDesactivar = false;

        return view('administracion.home', compact('especialidades','planteles', 'botonDesactivar'));
    }

    public function desactivarPlanteles()
    {

        try {
            Plantel::where('active', 1)
                ->update(['active' => 0]);
            return json_response([ 'isValid' => true ]);

        } catch (ModelNotFoundException $exception) {
            json_response([ 'isValid' => false ]);
        }

    }
}
