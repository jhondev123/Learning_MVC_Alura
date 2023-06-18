<?php

return[
    'GET|/'=> \Jhonattan\MVC\Controller\VideoListController::class,
    'GET|/novo-video' => \Jhonattan\MVC\Controller\VideoFormController::class,
    'POST|/novo-video' => \Jhonattan\MVC\Controller\NewVideoController::class,
    'GET|/editar-video'=> \Jhonattan\MVC\Controller\VideoFormController::class,
    'POST|/editar-video' => \Jhonattan\MVC\Controller\EditVideoController::class,
    'GET|/remover-video' => \Jhonattan\MVC\Controller\RemoveVideoController::class,
    'GET|/remover-image' => \Jhonattan\MVC\Controller\RemoveCardController::class,
    'GET|/registro'=> \Jhonattan\MVC\Controller\UserFormController::class,
    'POST|/registro'=> \Jhonattan\MVC\Controller\NewUserController::class,
    'GET|/login' => \Jhonattan\MVC\Controller\LoginFormController::class,
    'POST|/login' => \Jhonattan\MVC\Controller\LoginController::class,
    'GET|/logout' => \Jhonattan\MVC\Controller\LogoutController::class,
    'GET|/cadastro' => \Jhonattan\MVC\Controller\UserFormController::class,
    'GET|/videos-json' => \Jhonattan\MVC\Controller\JsonVideoListController::class,
    'POST|/videos' => \Jhonattan\MVC\Controller\NewJsonVideoController::class,
];