<?php

namespace App\Controller;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class HomeController
{
    public function index(): ResponseInterface 
    {
        return new Response(200, [], 'Welcome to the Show Page');
    }
}