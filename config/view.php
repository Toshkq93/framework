<?php

return [
    'default' => env('VIEW_RENDER', 'smarty'),

    'smarty' => [
        'smarty_caching' => env('CACHING'),
        'smarty_cache_lifetime' => env('CACHE_LIFETIME'),
        'smarty_debugging' => env('DEBUGGING'),
        'smarty_html_minify' => env('HTML_MINIFY'),
        'smarty_compile_check' => env('COMPILE_CHECK'),
    ],
];