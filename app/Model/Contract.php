<?php

namespace App\Model;

class Contract
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Database();
    }

    public function getAmount($sort)
    {
        $query = "SELECT * FROM contracts WHERE id = ? AND kwota > 10";
        
        if ($sort == 'DESC') {
            $query .= " ORDER BY nazwa_przedsiebiorcy DESC, NIP DESC";
        } elseif ($sort == 'ASC') {
            $query .= " ORDER BY kwota";
        }

        $result = $this->connection->query($query);

        return $result;
    }

    public function all()
    {
        $query = "SELECT * FROM contracts ORDER BY id";
        
        $result = $this->connection->query($query);

        return $result;
    }

}