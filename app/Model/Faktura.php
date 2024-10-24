<?php
namespace App\Model;

use App\Model\Database;

class Faktura {
    
    private $connection;

    public function __construct()
    {
        $this->connection = new Database;
    }

    public function all()
    {
        return $this->connection->query('SELECT * FROM faktury');
    }

}

$faktura = new Faktura();
var_dump($faktura->all());