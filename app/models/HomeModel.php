<?php

namespace App\Models;
use Core\Model;

class HomeModel extends Model
{
    public function getMessage()
    {
        return "Hello, MVC with OOP in PHP!";
    }
}
