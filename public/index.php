<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use App\Controller\HomeController;
use App\Controller\ShowController;

$request = ServerRequest::fromGlobals();

$path = $request->getUri()->getPath();
$basePath = '/zadanie-testowe/public';

if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

$response = new Response();

switch ($path) {
    case '/':
        $controller = new HomeController();
        $response = $controller->index();
        break;
    case '/show':
        $controller = new ShowController();
        $response = $controller->index();
        break;
}

$emitter = new SapiEmitter();
$emitter->emit($response);