<?php

use Core\ContainerInstance;
use Core\DB;
use Core\Router;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv::createUnsafeImmutable(base_path())->load();
}catch (InvalidPathException $exception){
    return $exception->getMessage();
}

$container = (new ContainerBuilder())
    ->addDefinitions(base_path('bootstrap\container.php'));
$container = $container->build();

$container->call([$container->get(Session::class), 'start']);

$db = new DB($container);

ContainerInstance::set($container);

$router = new Router(
    $container,
    getValidUri()
);
