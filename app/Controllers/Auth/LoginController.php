<?php

namespace App\Controllers\Auth;

use Core\Auth\Auth;
use Core\Controller;
use Laminas\Diactoros\ServerRequest;

class LoginController extends Controller
{
    protected $auth;

    public function __construct(
        Auth $auth
    )
    {
        $this->auth = $auth;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function signin(ServerRequest $request)
    {
        $data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (!$this->auth->attemp($data['email'], $data['password'])){

        }

        return header('Location: /');
    }
}