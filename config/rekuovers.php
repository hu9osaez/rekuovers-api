<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Domains
    |--------------------------------------------------------------------------
    |
    | Where web and API routes are run
    |
    */

    'domain' => [
        'web' => env('WEB_DOMAIN', 'rekuovers.com'),
        'api' => env('API_DOMAIN', 'api.rekuovers.com'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Expire time for a song in cache
    |--------------------------------------------------------------------------
    |
    | The expire time is the number of minutes that the expire a song in system cache
    | Default: 15 days
    |
    */
    'expire_cache_song' => 60 * 60 * 6,
];
