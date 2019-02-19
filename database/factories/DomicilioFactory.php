<?php

use Aspirante\Models\Domicilio;
use Faker\Generator as Faker;

$factory->define(Domicilio::class, function (Faker $faker) {

    $municipioId = \ExamenEducacionMedia\Models\Geodatabase\MunicipioView::inRandomOrder()->first()->CVE_MUN;
    $localidadId = \ExamenEducacionMedia\Models\Geodatabase\Localidad::where('CVE_ENT', 23)
        ->where('CVE_MUN', $municipioId)
        ->inRandomOrder()->first()->CVE_LOC;

    return [
        'cve_ent'       => '23',
        'cve_mun'       => $municipioId,
        'cve_loc'       => $localidadId,
        'colonia'       => $faker->streetAddress,
        'calle'         => $faker->streetName,
        'numero'        => $faker->numerify('####'),
        'codigo_postal' => $faker->postcode,
    ];
});
