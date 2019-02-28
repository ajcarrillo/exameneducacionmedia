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
                'id'          => 1,
                'nombre'      => 'AFORO',
                'descripcion' => 'AFORO',
                'apertura'    => '2018-01-01',
                'cierre'      => '2018-12-31',
            ],
            [
                'id'          => 2,
                'nombre'      => 'OFERTA',
                'descripcion' => 'OFERTA',
                'apertura'    => '2018-01-01',
                'cierre'      => '2018-12-31',
            ],
            [
                'id'          => 3,
                'nombre'      => 'REGISTRO',
                'descripcion' => 'REGISTRO',
                'apertura'    => '2018-01-01',
                'cierre'      => '2018-12-31',
            ],
        ];

        foreach ($etapas as $etapa) {
            $e = new \ExamenEducacionMedia\Models\EtapaProceso($etapa);
            $e->save();
        }
    }
}
