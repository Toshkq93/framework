<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Auth\Auth;
use Core\Controller;
use Core\Session\Flash;
use Laminas\Diactoros\ServerRequest;

class RegisterController extends Controller
{
    public function __construct(
        protected User $user,
        protected Auth $auth,
        protected Flash $flash
    )
    {
    }

    public function register()
    {
        return view('auth.register');
    }

    public function signup(ServerRequest $request)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email', ['exists', User::class]],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['required', ['equals', 'password']],
        ]);

        $this->user->create($data);

        if (!$this->auth->attemp($data['email'], $data['password'])) {
            $this->flash->set('error', 'email or password is not ivalid!');

            return back();
        }

        return redirect('/');
    }
}