<?php

namespace ExamenEducacionMedia\Console\Commands;

use ExamenEducacionMedia\User;
use Illuminate\Console\Command;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createsuperuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un usuario administrador del sistema.';

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
        $nombre           = $this->ask('Nombre');
        $primer_apellido  = $this->ask('Primer apellido');
        $segundo_apellido = $this->ask('Segundo apellido');
        $email            = $this->ask('Email');
        $password         = $this->ask('Password');

        $data = [
            'nombre'           => $nombre,
            'primer_apellido'  => $primer_apellido,
            'segundo_apellido' => $segundo_apellido,
            'email'            => $email,
            'password'         => $password,
        ];

        $user = User::createUser($data, [ 'supermario', 'departamento' ]);

        if ($user) {
            $this->info('El usuario se creó correctamente');
        } else {
            $this->error('Something went wrong!');
        }

        return;
    }
}
