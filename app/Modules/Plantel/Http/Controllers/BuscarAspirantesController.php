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
use Illuminate\Support\Arr;

class BuscarAspirantesController extends Controller
{
    protected $aspiranteRepository;

    public function __construct(AspiranteRepository $repository)
    {
        $this->aspiranteRepository = $repository;
    }

    public function index(Request $request)
    {
        $subsistema = NULL;
        $search     = $request->search;
        $plantel    = optional(get_user()->plantel)->id;
        $subsistema = optional(get_user()->subsistema)->id;

        $params = compact('search', 'plantel', 'subsistema');

        $aspirantes = $this->aspiranteRepository
            ->listarAspirantesPorPlantel($params)
            ->paginate(50);

        $aspirantes->appends($params);

        return view('planteles.buscar_aspirantes.index', compact('aspirantes'));
    }
}
