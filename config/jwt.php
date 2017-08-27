<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Secret Key
    |--------------------------------------------------------------------------
    |
    | Secret key used to encode and decode JSON Web Tokens
    | and the serialization and unserialization of objects.
    |
    */

    'secret_key' => env('APP_KEY'),

    /*
    |--------------------------------------------------------------------------
    | JWT Duration
    |--------------------------------------------------------------------------
    |
    | JWT duration in minutes.
    |
    */

    'jwt_token_duration' => 120,

    /*
    |--------------------------------------------------------------------------
    | Enable Refresh JWT
    |--------------------------------------------------------------------------
    |
    | Enable the usage of refresh jwt.
    |
    */

    'enable_refresh_token' => true,

    /*
    |--------------------------------------------------------------------------
    | Refresh JWT Duration
    |--------------------------------------------------------------------------
    |
    | Refresh JWT duration in days.
    |
    */

    'refresh_token_duration' => 14,

];
