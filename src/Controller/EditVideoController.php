<?php

namespace Jhonattan\MVC\Controller;
use Jhonattan\MVC\Entity\Video;
use Jhonattan\MVC\Repository\VideoRepository;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {

    }

public function processaRequisicao():void
        {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id === false) {
                header('Location: /?sucesso=0');
                exit();
            }

            $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
            if ($url === false) {
                header('Location: /?sucesso=0');
                exit();
            }
            $titulo = filter_input(INPUT_POST, 'titulo');
            if ($titulo === false) {
                header('Location: /?sucesso=0');
                exit();
            }

            $video = new Video($url,$titulo);
            $video->setId($id);
            $sucess = $this->videoRepository->updateVideo($video);
            if($sucess === false){
                header('Location: /?sucesso=0');
            }else{
                header('Location: /?sucesso=1');
            }

        }

    }
