<?php

use Faker\Generator as Faker;

$factory->define(\Subsistema\Models\OfertaEducativa::class, function (Faker $faker) {
    return [
        'plantel_id'          => \Subsistema\Models\Plantel::inRandomOrder()->value('id'),
        'especialidad_id'     => \Subsistema\Models\Especialidad::inRandomOrder()->value('id'),
        'active'              => true,
        'clave'               => $faker->numerify('####'),
        'programa_estudio_id' => \Subsistema\Models\ProgramaEstudio::inRandomOrder()->value('id'),
    ];
});
