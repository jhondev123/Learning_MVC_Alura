<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Helper\FlashMessageTrait;
use Jhonattan\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveCardController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParamsGet = $request->getQueryParams();

        $id = filter_var($queryParamsGet['id'], FILTER_VALIDATE_INT);
        if ($id === false || null) {
            $this->addErrorMessage("Erro ao editar video");
            return new Response(302, [
                "location" => '/'
            ]);
        }
        $success = $this->videoRepository->removeImage($id);
        if($success === false){
            header('Location: /?sucesso=0');
        }else{
            header('Location: /?sucesso=1');
        }

    }
}