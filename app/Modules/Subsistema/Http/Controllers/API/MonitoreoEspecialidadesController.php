<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-10
 * Time: 13:24
 */

namespace Subsistema\Http\Controllers\API;


use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Subsistema\Repositories\OfertaEducativaRepository;

class MonitoreoEspecialidadesController extends Controller
{
    /**
     * @var OfertaEducativaRepository
     */
    private $ofertaEducativaRepository;

    public function __construct(OfertaEducativaRepository $ofertaEducativaRepository)
    {
        $this->ofertaEducativaRepository = $ofertaEducativaRepository;
    }

    public function index(Request $request)
    {
        $params = $request->only([ 'subsistemaid', 'plantelid' ]);

        $especialidades = $this->ofertaEducativaRepository->monitoreoOferta($params)->get();

        return ok(compact('especialidades'));
    }
}
