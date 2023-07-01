<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Entity\Video;
use Jhonattan\MVC\Helper\FlashMessageTrait;
use Jhonattan\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);

        if ($id === false || null) {
            $this->addErrorMessage("Id invalido");
            return new Response(302, [
                "location" => '/'
            ]);
        }
        $success = $this->videoRepository->removeVideo($id);
        if ($success === false) {
            $this->addErrorMessage("Erro ao remover video");
            return new Response(302, [
                "location" => '/'
            ]);
        } else {
            return new Response(302, [
                "location" => '/'
            ]);
        }

    }
}

