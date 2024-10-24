<?php

namespace App\Controller;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class ShowController
{
    public function index(): ResponseInterface {
        return new Response(200, [], 'Welcome to the Home Page');
    }

}