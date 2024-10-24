<?php

namespace App\Controller;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class HomeController
{
    public function index(): ResponseInterface 
    {
        ob_start();
        require __DIR__ . '/../View/home.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
}