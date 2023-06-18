<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Entity\Video;
use Jhonattan\MVC\Repository\VideoRepository;

class JsonVideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $videoList = array_map(function (Video $video):array{
            return [
                'url'=>$video->url,
                'title'=>$video->title,
                'file_path'=>"/img/uploads/".$video->getFilePath()
            ];
        },$this->videoRepository->allVideos());
        echo json_encode($videoList);
    }


}