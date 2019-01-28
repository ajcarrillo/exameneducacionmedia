<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-27
 * Time: 22:39
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\EtapaProceso;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use Illuminate\Http\Request;
use MediaSuperior\Models\Enlace;

class EnlaceController extends Controller
{
    protected $home;

    public function __construct()
    {
        $this->home = route('media.administracion.enlaces.index');
    }

    public function index()
    {
        $enlaces = Enlace::with('municipio')->get();

        return view('administracion.enlaces.index', compact('enlaces'));
    }

    public function create()
    {
        $municipios = $this->getMunicipios();
        $registro   = $this->getEtapaRegistro();

        return view('administracion.enlaces.create', compact('municipios', 'registro'));
    }

    public function store(Request $request)
    {
        $this->validated($request);

        $enlace = new Enlace($request->input());
        $enlace->save();

        flash('El enlace se guardó correctamente')->success();
        if ($request->has('addanother')) {
            return back();
        }

        return redirect()->to($this->home);
    }

    public function edit(Enlace $enlace)
    {
        $municipios = $this->getMunicipios();
        $registro   = $this->getEtapaRegistro();

        return view('administracion.enlaces.edit', compact('municipios', 'registro', 'enlace'));
    }

    public function update(Request $request, Enlace $enlace)
    {
        $this->validated($request);

        $enlace->update($request->input());

        flash('El enlace se guardó correctamente')->success();

        if ($request->has('continue')) {
            return back();
        }

        return redirect()->to($this->home);
    }

    protected function validated($request)
    {
        $registro = $this->getEtapaRegistro();

        return $request->validate([
            'cve_ent'      => 'required|in:23',
            'cve_mun'      => 'required',
            'fecha_inicio' => 'required|before_or_equal:fecha_fin|after_or_equal:' . $registro->apertura,
            'fecha_fin'    => 'required|after_or_equal:fecha_inicio|before_or_equal:' . $registro->cierre,
            'hora_inicio'  => 'required',
            'hora_fin'     => 'required',
            'domicilio'    => 'required',
        ]);
    }

    protected function getMunicipios()
    {
        return MunicipioView::where('CVE_ENT', 23)
            ->orderBy('NOM_MUN')
            ->pluck('NOM_MUN', 'CVE_MUN');
    }

    protected function getEtapaRegistro()
    {
        return EtapaProceso::whereNombre('REGISTRO')->first();
    }
}
