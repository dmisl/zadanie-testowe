<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use App\Controller\HomeController;
use App\Controller\ShowController;

$request = ServerRequest::fromGlobals();

$path = $request->getUri()->getPath();
$basePath = '/zadanie-testowe';

if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
}

define('ROOT_PATH', dirname(__DIR__));

$response = new Response();

switch ($path) {
    case '/':
        $controller = new HomeController();
        $response = $controller->index();
        break;
    case '/auth':
        $controller = new HomeController();
        $response = $controller->auth($request);
        break;
    case '/nadplaty':
        $controller = new ShowController();
        $response = $controller->nadplaty($request);
        break;
    case '/niedoplaty':
        $controller = new ShowController();
        $response = $controller->niedoplaty();
        break;
    case '/zalegle':
        $controller = new ShowController();
        $response = $controller->zalegle();
        break;
}

$emitter = new SapiEmitter();
$emitter->emit($response);