<?php

namespace App\Controllers\Auth;

use Core\Controller;
use Laminas\Diactoros\ServerRequest;

class RegisterController extends Controller
{
    public function register()
    {
        view('auth.register');
    }

    public function signup(ServerRequest $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
    }
}