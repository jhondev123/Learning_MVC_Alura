<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Entity\Video;
use Jhonattan\MVC\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {

    }

    public function processaRequisicao():void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('Location: /?sucesso=0');
            return;

        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /?sucesso=0');
            return;
        }
        $sucess = $this->videoRepository->addVideo(new Video($url,$titulo));
        if($sucess === false){
            header('Location: /?sucesso=0');
        }else{
            header('Location: /?sucesso=1');
        }

    }

}