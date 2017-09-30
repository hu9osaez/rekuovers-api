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
];