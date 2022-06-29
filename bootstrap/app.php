<?php

use Core\Config;
use Core\ContainerInstance;
use Core\Contracts\SessionInterface;
use Core\DB;
use Core\Handler;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use League\Route\Strategy\StrategyInterface;
use Psr\Http\Message\ServerRequestInterface;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv::createUnsafeImmutable(base_path())->load();
} catch (InvalidPathException $exception) {
    return $exception->getMessage();
}

$container = (new ContainerBuilder())
    ->addDefinitions(base_path('bootstrap\container.php'));
$container = $container->build();

$db = new DB($container);

ContainerInstance::set($container);

$strategy = (new ApplicationStrategy())->setContainer($container);
$container->set(StrategyInterface::class, $strategy);
$router = $container->get(Router::class)->setStrategy($container->get(StrategyInterface::class));

require_once base_path('routes/web.php');

foreach ($container->get(Config::class)->get('app.middleware') as $middleware) {
    $router->lazyMiddleware($middleware);
}

try {
    $router->dispatch(
        $container->get(ServerRequestInterface::class)
    );
} catch (Exception $exception) {
    $handler = new Handler(
        $exception,
        $container->get(SessionInterface::class)
    );

    $handler->response();
}
