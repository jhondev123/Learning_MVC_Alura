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

require_once  "../vendor/autoload.php";
require_once __DIR__ ."/../connectionCreator.php";
$routes = require_once __DIR__ . "/../config/routes.php";


$pdo = ConnectionCreator::createConnection();
$videoRepository = new VideoRepository($pdo);
$userRepository = new UserRepository($pdo);

/** @var Jhonattan\MVC\Controller\ $controller */

$pathInfo=$_SERVER['PATH_INFO'] ?? '/';


$httpMethod =$_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

$isLoginRoute = $pathInfo === '/login';

$isLoginRoute = $pathInfo === '/login';

if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    $controller = new $controllerClass($videoRepository);
} else {
    $controller = new Error404Controller();
}
/** @var Controller $controller */
$controller->processaRequisicao();
