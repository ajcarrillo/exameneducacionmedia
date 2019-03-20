<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\Aspirante\Models\Aspirante::class, function (Faker $faker) {

    return [
        'alumno_id'             => NULL,
        'telefono'              => $faker->phoneNumber,
        'sexo'                  => $faker->randomElement([ 'H', 'M' ]),
        'folio'                 => random_int(1, 999999999),
        'pais_nacimiento_id'    => \ExamenEducacionMedia\Models\Geodatabase\Pais::inRandomOrder()->first()->id,
        'entidad_nacimiento_id' => \ExamenEducacionMedia\Models\Entidad::inRandomOrder()->first()->id,
        'fecha_nacimiento'      => $faker->dateTimeBetween('-17 years', '-13 years'),
        'curp'                  => NULL,
        'curp_historica'        => NULL,
        'curp_valida'           => NULL,
    ];
});
