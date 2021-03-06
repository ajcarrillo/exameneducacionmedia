<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EtapaProcesoTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(CreateSampleUsersTableSeeder::class);
        $this->call(FoliosTableSeeder::class);
        $this->call(AspirantesTableSeeder::class);

        $files = [
            'database/queries/subsistemas.sql',
            'database/queries/especialidades.sql',
            'database/queries/programas_estudio.sql',
            'database/queries/planteles.sql',
            'database/queries/configuraciones.sql',
            'database/queries/entidades.sql',
            'database/queries/ceneval_diccionarios.sql',
            'database/queries/ceneval_preguntas.sql',
            'database/queries/ceneval_respuestas.sql',
            'database/queries/ofertas_educativas.sql',
        ];
        foreach ($files as $path) {
            DB::unprepared(file_get_contents($path));
            $this->command->info("{$path} has been run");
        }
    }
}
