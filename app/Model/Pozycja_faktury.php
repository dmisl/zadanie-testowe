<?php
namespace App\Model;

use App\Model\Database;

class Pozycja_faktury {
    
    private $connection;

    public function __construct()
    {
        $this->connection = new Database;
    }

    public function all()
    {
        return $this->connection->query('SELECT * FROM pozycja_faktury');
    }

}