<?php

namespace App\Models;
use Core\Model;

class ApiModel extends Model
{

    public function getCarList()
    {
        $query = $this->db->prepare("SELECT * FROM car c JOIN type t ON c.id_type = t.id_type");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
