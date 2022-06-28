<?php

use Core\Config;
use Core\Loaders\ArrayLoader;
use Core\View;
use DebugBar\DebugBar;
use DebugBar\StandardDebugBar;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

return [
    Session::class => new Session(),
    Request::class => new Request(
        $_GET,
        $_POST,
        [],
        $_COOKIE,
        $_FILES,
        $_SERVER
    ),
    DebugBar::class => new StandardDebugBar(),
    View::class => function (ContainerInterface $container){
        $view = new View($container);

        if (env('DEBUG')){
            $view->assign('debugbarRenderer', $container->get(DebugBar::class)->getJavascriptRenderer());
        }

        return $view;
    },
    Config::class => function (){
        $arrayLoader = new ArrayLoader(base_path('config'));

        return (new Config())
            ->load([$arrayLoader]);
    },
];
