<?php

namespace Core\Middleware;

use Core\Auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Authenticate implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
//        $auth = app(Auth::class);
//
//        if ($auth->hasUserInSession()){
//            try {
//                $auth->setUserFromSession();
//            }catch (\Exception $exception){
////                $auth->logout();
//            }
//        }

        return $handler->handle($request);
    }
}