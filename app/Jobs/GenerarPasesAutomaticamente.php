<?php

namespace ExamenEducacionMedia\Jobs;

use Aspirante\Models\Aspirante;
use Aspirante\Repositories\AspiranteRepository;
use ExamenEducacionMedia\Mail\EnviarInformacionPasesAutomaticosMail;
use ExamenEducacionMedia\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class GenerarPasesAutomaticamente implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var AspiranteRepository
     */
    private $aspiranteRepository;

    /**
     * Create a new job instance.
     *
     * @param AspiranteRepository $aspiranteRepository
     */
    public function __construct(AspiranteRepository $aspiranteRepository)
    {

        $this->aspiranteRepository = $aspiranteRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Throwable
     */
    public function handle()
    {
        $totalAspirantes = $this->aspiranteRepository->listarAspirantes([ 'conpagosinpase' => 1 ])->count();
        $generados       = 0;
        $planteles       = [];

        $this->aspiranteRepository->listarAspirantes([ 'conpagosinpase' => 1 ])->chunk(300, function ($aspirantes) use ($generados, $planteles) {
            foreach ($aspirantes as $a) {
                try {
                    $aspirante = Aspirante::find($a->id);
                    $aspirante->asignarPase();
                    $generados += 1;
                } catch (\Exception $e) {
                    $opcion = Aspirante::query()
                        ->find($a->id)
                        ->opcionesEducativas()
                        ->with('ofertaEducativa', 'ofertaEducativa.plantel:id,descripcion')
                        ->where('preferencia', 1)
                        ->first();

                    array_push($planteles, $opcion->ofertaEducativa->plantel->descripcion);
                }
            }
        });

        $user = User::whereIn('email', [ 'paenms.media@gmail.com', 'andresjch2804@gmail.com' ])->get();

        Mail::to($user)
            ->send(new EnviarInformacionPasesAutomaticosMail($totalAspirantes, $generados, $planteles));
    }
}
