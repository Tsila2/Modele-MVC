<?php

namespace App\Models;
use Core\Model;

class CarModel extends Model
{
    public function index()
    {
        return "Hello, MVC with OOP in PHP!";
    }

    public function createCar($data)
    {
        $id_type = $data['id_type'];
        $registration = $data['registration'];
        $name_car = $data['name_car'];
        $mark = $data['mark'];
        $price_day = $data['price_day'];
        $available = $data['available'];

        $query = $this->db->prepare("INSERT INTO `car`(`id_type`, `registration`, `name_car`, `mark`, `available`, `price_day`) VALUES ($id_type,'$registration','$name_car','$mark',$available,'$price_day')");

        try {
            $query->execute();
            return true;
        } catch (\Throwable $err) {
            return false;
        }
    }

    public function getCarList()
    {
        $query = $this->db->prepare("SELECT * FROM car c JOIN type t ON c.id_type = t.id_type");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCarById($id)
    {
        $query = $this->db->prepare("SELECT * FROM car   WHERE id_car = $id");
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateCarById($id, $data)
    {
        $id_type = $data['id_type'];
        $registration = $data['registration'];
        $name_car = $data['name_car'];
        $mark = $data['mark'];
        $price_day = $data['price_day'];

        $query = $this->db->prepare("UPDATE `car` SET `id_type`=$id_type,`registration`='$registration',`name_car`='$name_car',`mark`='$mark',`price_day`='$price_day' WHERE id_car = $id ");
        
        try {
            $query->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteCarById($id)
    {

        $query = $this->db->prepare("DELETE FROM `car` WHERE id_car = $id");
        
        try {
            $query->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function getCarListType()
    {
        $query = $this->db->prepare("SELECT * FROM `type`");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
