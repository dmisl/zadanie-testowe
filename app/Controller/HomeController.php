<?php

namespace App\Controller;

use App\Model\Klient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class HomeController
{
    public function index(): ResponseInterface 
    {
        $user_model = new Klient();
        return new Response(200, [], var_dump($user_model->nadplaty()));
        $users = $user_model->all();

        ob_start();
        require __DIR__ . '/../View/home.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
    public function auth(ServerRequest $request): ResponseInterface
    {
        $user_model = new Klient();
        $user_model->auth($request->getParsedBody()['user_id']);

        // RETURN TO THE PREVIOUS URL
        $referer = $request->getHeaderLine('Referer');

        if (!empty($referer)) {
            return new Response(302, ['Location' => $referer]);
        }

        return new Response(302, ['Location' => '/'.basename(ROOT_PATH).'/']);
    }
}