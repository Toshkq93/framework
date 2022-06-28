<?php

use Core\{
    ContainerInstance,
    Router
};

if (!function_exists('getValidUri')) {
    function getValidUri()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        return rawurldecode($uri);
    }
}

if (!function_exists('route')) {
    function route()
    {
        $container = ContainerInstance::get();

        return new Router($container, getValidUri());
    }
}

if (!function_exists('base_path')) {
    function base_path(string $path = '')
    {
        return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === null){
            return $default;
        }

        switch (strtolower($value)){
            case $value === 'true':
                return true;
            case $value == 'false':
                return false;
            default:
                return $value;
        }
    }
}