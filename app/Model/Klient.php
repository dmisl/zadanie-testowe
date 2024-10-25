<?php
namespace App\Model;

use App\Model\Database;

class Klient {
    
    private $connection;

    public function __construct()
    {
        $this->connection = new Database;
    }

    public function all()
    {
        return $this->connection->query('SELECT * FROM klienci');
    }

    public function auth($id)
    {
        $result = $this->connection->query("SELECT EXISTS(SELECT 1 FROM klienci WHERE id = $id) AS `exists`");
        $row = $result->fetch_assoc();
        if((bool)$row['exists'])
        {
            $_SESSION['user_id'] = $id;
        }
        return true;
    }

    public function nadplaty()
    {
        $wplaczic = $this->connection->query("SELECT SUM(faktury.suma_brutto) AS wplaczic FROM faktury WHERE faktury.klient_id = {$_SESSION['user_id']};")->fetch_assoc()['wplaczic'];
        $wplacono = $this->connection->query("SELECT SUM(platnosci.kwota) AS wplacono FROM platnosci JOIN faktury ON faktury.numer = platnosci.numer_faktury WHERE faktury.klient_id = {$_SESSION['user_id']};")->fetch_assoc()['wplacono'];
        return $wplacono-$wplaczic;
    }

}