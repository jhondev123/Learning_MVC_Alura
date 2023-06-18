<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Entity\Video;
use Jhonattan\MVC\Repository\VideoRepository;
use finfo;
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

        $video = new Video($url,$titulo);

        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mineType = $finfo->file($_FILES['image']['tmp_name']);
            if(str_starts_with($mineType,"image")){
                $safeFileName = uniqid('upload_') . "_". strtolower(basename($_FILES['image']['name']));
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ ."/../../public/img/uploads". $safeFileName
                );
                $video->setFilePath($safeFileName);
            }
        }

        $sucess = $this->videoRepository->addVideo($video);
        if($sucess === false){
            header('Location: /?sucesso=0');
        }else{
            header('Location: /?sucesso=1');
        }

    }

}