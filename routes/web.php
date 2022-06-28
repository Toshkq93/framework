<?php

use App\Controllers\{
    HomeController
};
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

return $dispatcher = simpleDispatcher(function (RouteCollector $route) {
    $route->get('/', [HomeController::class, 'index']);
    $route->get('/show', [HomeController::class, 'show']);
});