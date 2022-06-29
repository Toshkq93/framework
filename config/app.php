<?php

return [
    'name' => env('APP_NAME'),

    'middleware' => [
        \App\Middleware\ShareValidationErrors::class,
        \App\Middleware\ClearValidationErrors::class,
    ]
];