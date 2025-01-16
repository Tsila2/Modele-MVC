<?php

namespace Core;

use PDO;

class Model
{
    protected $db;

    public function __construct()
    {
        // $this->db = new PDO('mysql:host=localhost;dbname=biblio', 'root', '');
        $this->db = new PDO(
            sprintf('mysql:host=%s;dbname=%s', DATABASE_URL, DATABASE_NAME),
            DATABASE_USERNAME,
            DATABASE_PASSWORD
        );
    }
}
