<?php

declare(strict_types=1);

session_start();
if (isset($_SESSION['logado'])) {
    $originalInfo = $_SESSION['logado'];
    unset($_SESSION['logado']);
    session_regenerate_id();
    $_SESSION['logado'] = $originalInfo;
}

use Jhonattan\MVC\Controller\{Controller,
    EditVideoController,
    Error404Controller,
    NewVideoController,
    RemoveVideoController,
    VideoFormController,
    VideoListController};
use Jhonattan\MVC\Repository\UserRepository;
use Jhonattan\MVC\Repository\VideoRepository;
use Psr\Http\Server\RequestHandlerInterface;

require_once  "../vendor/autoload.php";
require_once __DIR__ ."/../connectionCreator.php";
$routes = require_once __DIR__ . "/../config/routes.php";
/** @var \Psr\Container\ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . "/../config/dependencies.php";




/** @var Jhonattan\MVC\Controller\ $controller */

$pathInfo=$_SERVER['PATH_INFO'] ?? '/';


$httpMethod =$_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

$isLoginRoute = $pathInfo === '/login';



$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    $controller =$diContainer->get($controllerClass);
} else {
    $controller = new Error404Controller();
}
$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

/** @var RequestHandlerInterface $controller */
$response = $controller->handle($request);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header (sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();