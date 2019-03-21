<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class AulasTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $planteles = \Subsistema\Models\Plantel::all();

        foreach ($planteles as $plantel) {
            $aula = new \Subsistema\Models\Aula([
                'referencia' => $faker->company,
                'capacidad'  => 50,
            ]);

            $plantel->aulas()->save($aula);
        }
    }
}
