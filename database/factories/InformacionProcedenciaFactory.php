<?php

use Aspirante\Models\InformacionProcedencia;
use Faker\Generator as Faker;

$factory->define(InformacionProcedencia::class, function (Faker $faker) {
    $ct = \DB::connection('centros_trabajo_db')
        ->table('centros_trabajo')
        ->where('nivel_educativo_id', 4)
        ->inRandomOrder()
        ->first();

    return [
        'clave_centro_trabajo'  => $ct->clave,
        'nombre_centro_trabajo' => $ct->nombre,
        'turno_id'              => 1,
        'fecha_egreso'          => '1970-03-12',
        'primera_vez'           => 1,
    ];
});
