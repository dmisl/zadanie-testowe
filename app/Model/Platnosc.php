<?php
namespace App\Model;

use App\Model\Database;

class Platnosc {
    
    private $connection;

    public function __construct()
    {
        $this->connection = new Database;
    }

    public function all()
    {
        return $this->connection->query('SELECT * FROM platnosci');
    }

}