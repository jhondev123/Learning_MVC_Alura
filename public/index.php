<?php

declare(strict_types=1);

use Jhonattan\MVC\Controller\{EditVideoController,
    Error404Controller,
    NewVideoController,
    RemoveVideoController,
    VideoFormController,
    VideoListController
};
use Jhonattan\MVC\Repository\VideoRepository;

require_once  "../vendor/autoload.php";
require_once __DIR__ ."/../connectionCreator.php";
$routes = require_once __DIR__ . "/../config/routes.php";
$pdo = ConnectionCreator::createConnection();
$videoRepository = new VideoRepository($pdo);
/** @var Jhonattan\MVC\Controller\ $controller */

$pathInfo=$_SERVER['PATH_INFO'] ?? '/';

$httpMethod =$_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";
if(array_key_exists($key,$routes)) {

    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass($videoRepository);
}else{
    $controller = new Error404Controller();
}
$controller->processaRequisicao();