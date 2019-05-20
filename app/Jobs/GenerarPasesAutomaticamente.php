<?php

namespace ExamenEducacionMedia\Jobs;

use Aspirante\Models\Aspirante;
use Aspirante\Repositories\AspiranteRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
        try {
            foreach ($this->aspirantes as $a) {
                $aspirante = Aspirante::find($a->id);

                $aspirante->asignarPase();
            }
        } catch (\Exception $e) {
        }
    }
}
