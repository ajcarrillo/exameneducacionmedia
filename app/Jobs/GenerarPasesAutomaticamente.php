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
    private $aspirantes;

    /**
     * Create a new job instance.
     *
     * @param $aspirantes
     */
    public function __construct($aspirantes)
    {

        $this->aspirantes = $aspirantes;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Throwable
     */
    public function handle()
    {
        $totalAspirantes = $this->aspirantes->count();
        $generados       = 0;
        $planteles       = [];
        foreach ($this->aspirantes as $a) {
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

        $user = User::whereIn('email', [ 'paenms.media@gmail.com', 'andresjch2804@gmail.com' ])->get();

        Mail::to($user)
            ->send(new EnviarInformacionPasesAutomaticosMail($totalAspirantes, $generados, $planteles));
    }
}
