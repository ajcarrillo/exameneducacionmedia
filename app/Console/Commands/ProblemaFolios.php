<?php

namespace ExamenEducacionMedia\Console\Commands;

use Aspirante\Models\Aspirante;
use DB;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio;
use Illuminate\Console\Command;

class ProblemaFolios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'problema:folios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Busca folios repetidos y los reinicio';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $aspirantes = DB::select('
        SELECT aspirantes.*
FROM aspirantes
WHERE folio IN (SELECT folio
FROM (SELECT folio, count(folio) folios
FROM aspirantes
GROUP BY folio
HAVING folios > 1) fuck)
        ');

        try {
            DB::transaction(function () use ($aspirantes) {
                foreach ($aspirantes as $aspirante) {
                    $a        = Aspirante::find($aspirante->id);
                    $folio    = Folio::getFolio();
                    $a->folio = $folio->folio;
                    $folio->desactivar();
                    $a->save();
                }
            });
        } catch (\Throwable $e) {
        }

        return;
    }
}
