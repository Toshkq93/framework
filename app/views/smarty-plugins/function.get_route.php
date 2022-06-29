<?php

function smarty_function_get_route($params, &$smarty)
{
    $router = app(\League\Route\Router::class);

    return $router->getNamedRoute($params['name'])->getPath();
}