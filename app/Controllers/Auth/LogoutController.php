<?php

namespace App\Controllers\Auth;

use Core\Auth\Auth;

class LogoutController
{
    public function __construct(
        protected Auth $auth
    )
    {
    }

    public function logout()
    {
        $this->auth->logout();

        return redirect('/');
    }
}