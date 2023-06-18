<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Repository\VideoRepository;

class VideoFormController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {

    }

    public function processaRequisicao():void
    {
        $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        $video = null;
        if($id !== null && $id !== false){
            $video = $this->repository->find($id);
        }
        require_once __DIR__ . "/../../views/form.php";

    }

}