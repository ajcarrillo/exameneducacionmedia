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

$factory->define(ExamenEducacionMedia\User::class, function (Faker $faker) {
    return [
        'uuid'                         => $faker->uuid,
        'nombre'                       => $faker->name,
        'primer_apellido'              => $faker->firstName,
        'segundo_apellido'             => $faker->lastName,
        'email'                        => $faker->unique()->email,
        'username'                     => $faker->unique()->userName,
        'password'                     => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'api_token'                    => str_random(60),
        'active'                       => true,
        'session_id'                   => NULL,
        'email_verified_at'            => NULL,
        'provider_id'                  => NULL,
        'provider'                     => NULL,
        'jarvis_user_access_token'     => NULL,
        'jarvis_user_token_type'       => NULL,
        'jarvis_user_token_expires_in' => NULL,
        'jarvis_user_refresh_token'    => NULL,
        'remember_token'               => NULL,
    ];
});
