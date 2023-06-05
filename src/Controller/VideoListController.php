<?php

namespace Jhonattan\MVC\Controller;
require_once __DIR__ . '/../../connectionCreator.php';

use Jhonattan\MVC\Repository\VideoRepository;


class VideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {



    }

    public function processaRequisicao():void
    {
        $videoList = $this->videoRepository->allVideos();
        require_once __DIR__ . "/../../views/video-list.php";

    }
}


