<?php

namespace App\Controllers;

use App\Models\User;
use Core\ContainerInstance;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{

    public function index()
    {
        $this->view->render('index.tpl');
    }

    public function show(Request $request)
    {
        $this->view->render('show.tpl');
    }
}