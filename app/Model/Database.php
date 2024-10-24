<?php
namespace App\Model;

class Database
{
    private $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect('localhost', 'root', '', 'zadanie'); 
        return $this->connection;
    }

    public function query($query)
    {
        $result = $this->connection->query($query);
        return $result;
    }
}