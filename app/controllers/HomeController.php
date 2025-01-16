<?php

namespace App\Controllers;
use Core\Controller;
use App\Models\UserModel;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index');
    }

    public function login()
    {
        

        // $this->view('home/index');
    }
}
