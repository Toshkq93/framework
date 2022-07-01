<?php

return [
    'name' => env('APP_NAME'),

    'middleware' => [
        \Core\Middleware\ShareValidationErrors::class,
        \Core\Middleware\ClearValidationErrors::class,
        \Core\Middleware\Authenticate::class,
        \Core\Middleware\CsrfVerify::class
    ]
];