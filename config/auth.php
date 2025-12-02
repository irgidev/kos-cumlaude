<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'staf', 
        ],
        'penghuni' => [
            'driver' => 'session',
            'provider' => 'penghuni',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'staf' => [
            'driver' => 'eloquent',
            'model' => App\Models\Staf::class,
        ],
        'penghuni' => [
            'driver' => 'eloquent',
            'model' => App\Models\Penghuni::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];