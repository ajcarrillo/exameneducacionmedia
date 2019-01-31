<?php
/**
 * Created by PhpStorm.
 * User: wsanchez
 * Date: 29/01/2019
 * Time: 11:26 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Http\Controllers\Controller;

use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;

use Illuminate\Http\Request;
use MediaSuperior\Models\Domicilio;
use MediaSuperior\Models\Plantel;
use MediaSuperior\Models\Localidad;
use MediaSuperior\Models\SedeAlterna;

class SedeAlternaController extends Controller
{
    public function index()
    {
        $sedes = SedeAlterna::get();

        return view('media_superior.administracion.sedesAlternas.index', compact('sedes'));
    }

    public function create()
    {
        $planteles = Plantel::pluck('descripcion', 'id');
        $municipios = $this->getMunicipios();
        $localidades   = $this->getLocalidades('004');

        return view('media_superior.administracion.sedesAlternas.create', compact('planteles', 'municipios', 'localidades'));
    }

    public function store(Request $request)
    {
        //$this->validated($request);

        $domicilio = new Domicilio($request->input());
        $domicilio->save();

        $sedeAlterna = SedeAlterna::create([
            'descripcion' => $request->get('descripcion'),
            'sede_ceneval' => $request->get('sede_ceneval'),
            'domicilio_id' => $domicilio->id,
            'plantel_id' => $request->get('plantel_id'),
        ]);


        $sedeAlterna = new SedeAlterna($request->input());
        $sedeAlterna->save();

        flash('La sede alterna se guardó correctamente')->success();
        if ($request->has('addanother')) {
            return back();
        }

        return redirect()->to($this->home);
    }

    public function edit(SedeAlterna $sedeAlterna)
    {
        $domicilio = Domicilio::find($sedeAlterna->domicilio_id);
        $planteles = Plantel::pluck('descripcion', 'id');
        $municipios = $this->getMunicipios();
        $localidades   = $this->getLocalidades('004');

        dd($domicilio);
        return view('media_superior.administracion.sedesAlternas.edit', compact('sedeAlterna', 'domicilio','planteles', 'municipios', 'localidades'));
    }


    public function update(Request $request)
    {
    }

    protected function getMunicipios()
    {
        return MunicipioView::where('CVE_ENT', 23)
            ->orderBy('NOM_MUN')
            ->pluck('NOM_MUN', 'CVE_MUN');
    }

    protected function getLocalidades($cve_mun)
    {
        return Localidad::where('CVE_ENT', 23)->where('CVE_MUN', $cve_mun)
                ->pluck('NOM_LOC', 'CVE_LOC');
    }

}