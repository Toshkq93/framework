<?php

namespace App\Controllers\Auth;

use Core\Auth\Auth;
use Core\Controller;
use Core\Session\Flash;
use Laminas\Diactoros\ServerRequest;

class LoginController extends Controller
{
    public function __construct(
        protected Auth  $auth,
        protected Flash $flash
    )
    {
    }

    public function login()
    {
        return view('auth.login');
    }

    public function signin(ServerRequest $request)
    {
        $data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!$this->auth->attemp($data['email'], $data['password'])) {
            $this->flash->set('error', 'Could not sign you in with those details.');

            return back();
        }

        $this->flash->set('success', 'You are logged!');

        return redirect('/');
    }
}