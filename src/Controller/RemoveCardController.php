<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Repository\VideoRepository;

class RemoveCardController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || null) {
            header('Location: /?sucesso=0');
            return;
        }
        $success = $this->videoRepository->removeImage($id);
        if($success === false){
            header('Location: /?sucesso=0');
        }else{
            header('Location: /?sucesso=1');
        }

    }
}