<?php

return [
    'dm' => [
        'driver'         => 'dm',
        'host'           => env('DB_HOST', '127.0.0.1'),
        'port'           => env('DB_PORT', '5236'),
        'database'       => env('DB_DATABASE', 'DAMENG'),
        'username'       => env('DB_USERNAME', 'SYSDBA'),
        'password'       => env('DB_PASSWORD', 'SYSDBA'),
        'charset'        => env('DB_CHARSET', 'UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
    ],
];
