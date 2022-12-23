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
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    /*'facebook' => [
        'client_id' => '517105098627326',
        'client_secret' => 'f51d3591ef3347ce780f856be6db3eff',
        'redirect' => env('APP_URL'),
    ],*/
    'facebook' => [
        'client_id' => '1657411444354068',
        'client_secret' => 'acbdded7c64b330ec6f409fb3ddee7d1',
        'redirect' => env('APP_URL').'/social/auth/facebook',
    ],
    'google' => [
        'client_id' => '139607884076-en5up1u1ju0a5noiskdj0e9m05td9ou3.apps.googleusercontent.com',
        'client_secret' => 'PG5nIo29jxMvS7wnGJr2lzXX',
        'redirect' => env('APP_URL')
    ],
];
