<?php

namespace App\Controller;

use App\Model\Database;
use App\Model\Klient;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class ShowController
{
    public function nadplaty($request): ResponseInterface 
    {
        $user_model = new Klient();
        $connection = new Database();
        if(isset($request->getParsedBody()['sort']))
        {
            $data = $connection->query("SELECT * FROM platnosci JOIN faktury ON faktury.numer = platnosci.numer_faktury WHERE faktury.klient_id = {$_SESSION['user_id']} ORDER BY numer {$request->getParsedBody()['sort']};");
        } else
        {
            $data = $connection->query("SELECT * FROM platnosci JOIN faktury ON faktury.numer = platnosci.numer_faktury WHERE faktury.klient_id = {$_SESSION['user_id']};");
        }
        $users = $user_model->all();
        $nadplaty = $user_model->nadplaty();
        $wplaczic = $user_model->wplaczic();
        $wplacono = $user_model->wplacono();
        

        ob_start();
        require __DIR__ . '/../View/nadplaty.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
    public function niedoplaty($request): ResponseInterface 
    {
        $user_model = new Klient();
        $connection = new Database();
        if(isset($request->getParsedBody()['sort']))
        {
            $data = $connection->query("SELECT * FROM platnosci JOIN faktury ON faktury.numer = platnosci.numer_faktury WHERE faktury.klient_id = {$_SESSION['user_id']} ORDER BY numer {$request->getParsedBody()['sort']};");
        } else
        {
            $data = $connection->query("SELECT * FROM platnosci JOIN faktury ON faktury.numer = platnosci.numer_faktury WHERE faktury.klient_id = {$_SESSION['user_id']};");
        }
        $users = $user_model->all();
        $niedoplaty = $user_model->niedoplaty();
        $wplaczic = $user_model->wplaczic();
        $wplacono = $user_model->wplacono();

        ob_start();
        require __DIR__ . '/../View/niedoplaty.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
    public function zalegle($request): ResponseInterface 
    {
        $user_model = new Klient();
        $users = $user_model->all();
        if(isset($request->getParsedBody()['sort']))
        {
            $zalegle = $user_model->zalegle($request->getParsedBody()['sort']);
        } else
        {
            $zalegle = $user_model->zalegle();
        }

        ob_start();
        require __DIR__ . '/../View/zalegle.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
}