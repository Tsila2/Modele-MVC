<?php

namespace App\Models;
use Core\Model;

class HomeModel extends Model
{
    public function getMessage()
    {
        return "Hello, MVC with OOP in PHP!";
    }

    public function verifyUser($data){
        $username = $data['username'];
        $password = $data['password'];

        $query = $this->db->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
}
