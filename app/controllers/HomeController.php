<?php

namespace App\Controllers;
use App\Models\HomeModel;
use Core\Controller;

class HomeController extends Controller
{

    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }
    public function index()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            header('location:' . BASE_URL . 'car');
        }

        $msg = null;
        if (isset($_GET['msg']) && $_GET['msg'] != '') {
            $msg = $_GET['msg'];
        }
        $this->view('home/index', ["msg" => $msg]);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // var_dump($_POST);
            $data = [
                "username" => $_POST['username'],
                "password" => $_POST['password'],
            ];

            $user = $this->homeModel->verifyUser($data);

            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header('location:' . BASE_URL . 'car');
            } else {
                header('location:' . BASE_URL . 'home?msg=1');
            }
        }
        // $this->view('home/index');
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('location:' . BASE_URL . 'home');
    }
}
