<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-05-20
 * Time: 11:59
 */

namespace MediaSuperior\Http\Controllers;


use Aspirante\Repositories\AspiranteRepository;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Jobs\GenerarPasesAutomaticamente;

class GenerarPaseAutomaticoController extends Controller
{
    /**
     * @var AspiranteRepository
     */
    private $aspiranteRepository;

    public function __construct(AspiranteRepository $aspiranteRepository)
    {
        $this->aspiranteRepository = $aspiranteRepository;
    }

    public function update()
    {
        //$aspirantes = $this->aspiranteRepository->listarAspirantes([ 'conpagosinpase' => 1 ])->get();

        GenerarPasesAutomaticamente::dispatch($this->aspiranteRepository)
            ->onConnection('database_pases_automaticos')
            ->onQueue('pases_automaticos');

        flash('Los pases al examen se están generando, al terminar se enviará los resultados a tu correo electrónico')->success();

        return back();
    }
}
