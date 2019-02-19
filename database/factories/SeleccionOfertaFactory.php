<?php

use Aspirante\Models\Seleccion;
use Faker\Generator as Faker;

$factory->define(Seleccion::class, function (Faker $faker) {
    return [
        'oferta_educativa_id' => \Subsistema\Models\OfertaEducativa::inRandomOrder()->first()->id,
    ];
});
