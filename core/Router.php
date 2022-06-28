<?php

namespace Core;

use FastRoute\Dispatcher;
use FastRoute\Dispatcher\GroupCountBased;
use Psr\Container\ContainerInterface;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    private GroupCountBased $dispatcher;
    private stdClass $routeInfo;

    public function __construct(
        private ContainerInterface $container,
        private string             $validUri
    )
    {
        $this->dispatcher = require_once base_path('routes\web.php');
        $this->setRouteInfo();
        $this->call();
    }

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function setRouteInfo(): void
    {
        $routeInfo = $this->dispatcher->dispatch($this->container->get(Request::class)->getMethod(), $this->validUri);

        $route = new stdClass;

        foreach ($routeInfo as $key => $item) {
            if ($key == 1) {
                if (isset($item[0])) {
                    $route->controller = $item[0];
                }
                if (isset($item[1])) {
                    $route->method = $item[1];
                }
            }
            if ($key == 2) {
                $route->params = $item;
            }
            if ($key == 0) {
                $route->method_dispatcher = $item;
            }
        }

        $this->routeInfo = $route;
    }

    /**
     * @return void
     */
    private function call(): void
    {
        switch ($this->routeInfo->method_dispatcher) {
            case Dispatcher::NOT_FOUND:
                die(Response::HTTP_NOT_FOUND);
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                die(Response::HTTP_METHOD_NOT_ALLOWED);
                break;
            case Dispatcher::FOUND:
                // Call base controller methods
                $this->container->call([$this->routeInfo->controller, 'call'], [$this->container]);
                // Call route action
                $this->container->call([$this->routeInfo->controller, $this->routeInfo->method], $this->routeInfo->params);
                break;
        }
    }
}