<?php

use Illuminate\Database\Seeder;

class EtapaProcesoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etapas = [
            [
                'nombre'      => 'AFORO',
                'descripcion' => 'AFORO',
                'apertura'    => '2018-10-01',
                'cierre'      => '2018-10-07',
            ],
            [
                'nombre'      => 'OFERTA',
                'descripcion' => 'OFERTA',
                'apertura'    => '2018-10-01',
                'cierre'      => '2018-10-07',
            ],
            [
                'nombre'      => 'REGISTRO',
                'descripcion' => 'REGISTRO',
                'apertura'    => '2018-10-01',
                'cierre'      => '2018-10-07',
            ],
        ];

        foreach ($etapas as $etapa) {
            $e = new \ExamenEducacionMedia\Models\EtapaProceso($etapa);
            $e->save();
        }
    }
}
