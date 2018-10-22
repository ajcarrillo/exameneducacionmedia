<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => ExamenEducacionMedia\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'jarvis' => [
        'client_secret'         => env('JARVIS_SECRET', NULL),
        'client_id'             => env('JARVIS_CLIENT_ID', NULL),
        'jarvis_auth_url'       => env('JARVIS_AUTH_URL', NULL),
        'jarvis_auth_url_token' => env('JARVIS_AUTH_URL_TOKEN', NULL),
        'jarvis_api_url'        => env('JARVIS_API_URL', NULL),
    ],

];
