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
        'alumno_id'                  => NULL,
        'telefono'                   => NULL,
        'sexo'                       => NULL,
        'folio'                      => random_int(1, 9999999999),
        'pais_nacimiento_id'         => NULL,
        'entidad_nacimiento_id'      => NULL,
        'domicilio_id'               => NULL,
        'informacion_procedencia_id' => NULL,
        'fecha_nacimiento'           => NULL,
        'curp'                       => NULL,
        'curp_historica'             => NULL,
        'curp_valida'                 => NULL,
    ];
});
