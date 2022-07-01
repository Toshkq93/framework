<?php

namespace Core\Middleware;

use Core\Csrf;
use Core\Exceptions\CsrfTokenException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CsrfVerify implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $csrf = app(Csrf::class);

        if (!$this->requestRequiresMethods($request)) {
            return $handler->handle($request);
        }

        if (!$csrf->tokenIsInvalid($this->getTokenFromRequest($request, $csrf))) {
            throw new CsrfTokenException();
        }

        return $handler->handle($request);
    }

    protected function getTokenFromRequest(ServerRequestInterface $request, Csrf $csrf)
    {
        return $request->getParsedBody()[$csrf->key()] ?? null;
    }

    protected function requestRequiresMethods(ServerRequestInterface $request)
    {
        return in_array($request->getMethod(), ['POST', 'PUT', 'PATCH', 'DELETE']);
    }
}