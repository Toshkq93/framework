<?php

use League\Route\Router;
use Psr\Container\ContainerInterface;
use Somnambulist\Components\Validation\Factory;
use Core\Loaders\ArrayLoader;
use Core\{
    BcryptHasher,
    Session,
    View
};
use Core\Config;
use Core\Contracts\{
    HasherInterface,
    SessionInterface
};
use Psr\Http\Message\{
    ResponseInterface,
    ServerRequestInterface
};
use Laminas\Diactoros\{
    Response,
    ServerRequestFactory
};

return [
    ServerRequestInterface::class => function () {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    },
    ResponseInterface::class => new Response(),
    Factory::class => new Factory(),
    View::class => function (ContainerInterface $container) {
        $view = new View($container);

        return $view;
    },
    Config::class => function () {
        $arrayLoader = new ArrayLoader(base_path('config'));

        return (new Config())
            ->load([$arrayLoader]);
    },
    Router::class => new Router(),
    SessionInterface::class => new Session(),
    HasherInterface::class => new BcryptHasher(),
];
