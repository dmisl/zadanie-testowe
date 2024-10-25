<?php

namespace App\Controller;

use App\Model\Database;
use App\Model\Klient;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class ShowController
{
    public function nadplaty(): ResponseInterface 
    {
        $user_model = new Klient();
        $users = $user_model->all();
        $nadplaty = $user_model->nadplaty();
        $wplaczic = $user_model->wplaczic();
        $wplacono = $user_model->wplacono();
        $connection = new Database();
        $data = $connection->query("SELECT * FROM platnosci JOIN faktury ON faktury.numer = platnosci.numer_faktury WHERE faktury.klient_id = {$_SESSION['user_id']};");

        ob_start();
        require __DIR__ . '/../View/nadplaty.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
    public function niedoplaty(): ResponseInterface 
    {
        $user_model = new Klient();
        $users = $user_model->all();
        $niedoplaty = $user_model->niedoplaty();
        $wplaczic = $user_model->wplaczic();
        $wplacono = $user_model->wplacono();
        $connection = new Database();
        $data = $connection->query("SELECT * FROM platnosci JOIN faktury ON faktury.numer = platnosci.numer_faktury WHERE faktury.klient_id = {$_SESSION['user_id']};");

        ob_start();
        require __DIR__ . '/../View/niedoplaty.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
}