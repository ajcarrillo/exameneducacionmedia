<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-27
 * Time: 00:26
 */

namespace Plantel\Http\Controllers;


use Aspirante\Repositories\AspiranteRepository;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuscarAspirantesController extends Controller
{
    protected $aspiranteRepository;

    public function __construct(AspiranteRepository $repository)
    {
        $this->aspiranteRepository = $repository;
    }

    public function index(Request $request)
    {
        $params  = $request->only([ 'search' ]);
        $plantel = get_user()->plantel->id;

        $aspirantes = $this->aspiranteRepository
            ->listarAspirantesPorPlantel($plantel, $params)
            ->paginate(50);

        $aspirantes->appends($params);

        return view('planteles.buscar_aspirantes.index', compact('aspirantes'));
    }
}
