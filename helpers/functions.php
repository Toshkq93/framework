<?php

use Core\{
    ContainerInstance,
    View
};
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;

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

if (!function_exists('redirect')) {
    function redirect(string $url, int $status = 302, array $headers = [])
    {
        return new RedirectResponse($url, $status, $headers);
    }
}

if (!function_exists('view')) {
    function view(string $template, array $data = [])
    {
        $response = app(ResponseInterface::class);
        $response->getBody()->write(
            app(View::class)->render(str_replace('.', '/', $template) . '.tpl', $data)
        );

        return $response;
    }
}

if (!function_exists('app')) {
    function app(string $instance = null)
    {
        return $instance ? ContainerInstance::get()->get($instance) : ContainerInstance::get();
    }
}