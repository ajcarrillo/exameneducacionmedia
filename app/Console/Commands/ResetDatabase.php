<?php

namespace ExamenEducacionMedia\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class ResetDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resetdatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reinicia la base de datos para empezar un nuevo proceso de registro';

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
        if ($this->confirm('Esta seguro? Esta acción no se puede deshacer. Se eliminará toda la información del sistema.')) {
            Artisan::call('db:seed', [ '--class' => 'ResetDatabase' ]);
            $this->info('La base de datos se reinició correctamente');
        } else {
            $this->info('Se canceló la operación');
        }

        return;
    }
}
