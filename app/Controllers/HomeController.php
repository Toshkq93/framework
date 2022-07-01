<?php

namespace App\Controllers;

use Core\Auth\Auth;
use Core\Controller;

class HomeController extends Controller
{
    public function __construct(
        protected Auth $auth
    )
    {
    }

    public function index()
    {
        return view('index');
    }
}