<?php

use League\Route\Router;

function smarty_function_get_route($params, &$smarty)
{
    $router = app(Router::class);

    return $router->getNamedRoute($params['name'])->getPath();
}