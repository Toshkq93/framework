<?php

use App\Controllers\Auth\{
    LoginController,
    LogoutController,
    RegisterController
};
use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index'])->setName('home');

$router->group('/auth', function ($router) {
    $router->get('register', [RegisterController::class, 'register'])->setName('auth.register');
    $router->post('signup', [RegisterController::class, 'signup'])->setName('auth.signup');

    $router->get('login', [LoginController::class, 'login'])->setName('auth.login');
    $router->post('signin', [LoginController::class, 'signin'])->setName('auth.signin');

    $router->get('/logout', [LogoutController::class, 'logout'])->setName('auth.logout');
});