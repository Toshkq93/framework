<?php

namespace Core\Middleware;

use Core\Contracts\SessionInterface;
use Core\View;
use Psr\Http\Message\{
    ResponseInterface,
    ServerRequestInterface,
};
use Psr\Http\Server\{
    MiddlewareInterface,
    RequestHandlerInterface
};

class ShareValidationErrors implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $session = app(SessionInterface::class);

        app(View::class)->shareGlobal([
            'errors' => $session->get('errors', []),
            'old' => $session->get('old', [])
        ]);

        return $handler->handle($request);
    }
}