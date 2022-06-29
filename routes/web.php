<?php

use App\Controllers\Auth\{
    LoginController,
    RegisterController
};
use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index'])->setName('home');

$router->group('/auth', function ($route) {
    $route->get('register', [RegisterController::class, 'register'])->setName('auth.register');
    $route->post('signup', [RegisterController::class, 'signup'])->setName('auth.signup');


    $route->get('login', [LoginController::class, 'login'])->setName('auth.login');
    $route->post('signin', [[LoginController::class, 'signin']])->setName('auth.signin');
});