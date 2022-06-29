<?php

use Core\{
    ContainerInstance,
    View
};
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;

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

        if ($value === null) {
            return $default;
        }

        switch (strtolower($value)) {
            case $value === 'true':
                return true;
            case $value == 'false':
                return false;
            default:
                return $value;
        }
    }
}

/*if (!function_exists('redirect')) {
    function redirect(string $url, int $status = 302, array $headers = [])
    {
        return new \Laminas\Diactoros\Response($url, $status, $headers);
    }
}*/

/*if (!function_exists('back')) {
    function back(): RedirectResponse
    {
        return redirect(
            ContainerInstance::get()
                ->get(ServerRequestInterface::class)
                ->getServerParams()['HTTP_REFERER']
        );
    }
}*/

if (!function_exists('view')) {
    function view(string $template, array $data = [])
    {
        app(View::class)->render(str_replace('.', '/', $template) . '.tpl', $data);
    }
}

if (!function_exists('app')) {
    function app(string $instance = null)
    {
        return $instance ? ContainerInstance::get()->get($instance) : ContainerInstance::get();
    }
}