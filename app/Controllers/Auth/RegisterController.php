<?php

namespace App\Controllers\Auth;

use Core\Controller;
use Laminas\Diactoros\ServerRequest;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function signup(ServerRequest $request)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    }
}