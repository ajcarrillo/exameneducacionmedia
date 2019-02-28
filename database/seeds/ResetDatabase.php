<?php

use Illuminate\Database\Seeder;

class ResetDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = [
            'database/queries/truncate_tables.sql',
            'database/queries/ceneval_diccionarios.sql',
            'database/queries/ceneval_preguntas.sql',
            'database/queries/ceneval_respuestas.sql',
            'database/queries/configuraciones.sql',
            'database/queries/entidades.sql',
            'database/queries/especialidades.sql',
            'database/queries/ofertas_educativas.sql',
            'database/queries/planteles.sql',
            'database/queries/programas_estudio.sql',
            'database/queries/roles.sql',
            'database/queries/subsistemas.sql',
        ];
        foreach ($files as $path) {
            DB::unprepared(file_get_contents($path));
            $this->command->info("{$path} has been run");
        }
    }
}
