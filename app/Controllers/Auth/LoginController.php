<?php

namespace App\Controllers\Auth;

use Core\Controller;
use Laminas\Diactoros\ServerRequest;

class LoginController extends Controller
{
    public function login()
    {
        view('auth.login');
    }

    public function signin(ServerRequest $request)
    {
        dd($request->getParsedBody());
    }
}