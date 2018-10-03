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

        $files = [
            'database/queries/subsistemas.sql',
            'database/queries/planteles.sql',
            'database/queries/especialidades.sql',
            'database/queries/programas_estudio.sql',
            'database/queries/ofertas_educativas.sql',
            'database/queries/groups.sql',
        ];
        foreach ($files as $path) {
            DB::unprepared(file_get_contents($path));
            $this->command->info("{$path} has been run");
        }
    }
}
