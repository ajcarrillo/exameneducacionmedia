<?php

use Faker\Generator as Faker;

$factory->define(\ExamenEducacionMedia\Models\EtapaProceso::class, function (Faker $faker) {
    return [
        'nombre'      => $faker->colorName,
        'descripcion' => $faker->colorName,
        'apertura'    => \Carbon\Carbon::now()->format('Y-m-d'),
        'cierre'      => \Carbon\Carbon::now()->format('Y-m-d'),
    ];
});
