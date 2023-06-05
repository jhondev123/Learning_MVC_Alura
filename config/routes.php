<?php

return[
    'GET|/'=> \Jhonattan\MVC\Controller\VideoListController::class,
    'GET|/novo-video' => \Jhonattan\MVC\Controller\VideoFormController::class,
    'POST|/novo-video' => \Jhonattan\MVC\Controller\NewVideoController::class,
    'GET|/editar-video'=> \Jhonattan\MVC\Controller\VideoFormController::class,
    'POST|/editar-video' => \Jhonattan\MVC\Controller\EditVideoController::class,
    'GET|/remover-video' => \Jhonattan\MVC\Controller\RemoveVideoController::class

];