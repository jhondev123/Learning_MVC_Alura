<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Helper\HtmlRenderererTrait;
use Jhonattan\MVC\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoFormController  implements RequestHandlerInterface
{
    use HtmlRenderererTrait;
    public function __construct(private VideoRepository $repository, private Engine $template)
    {

    }

    public function handle(ServerRequestInterface $request):ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'] ??'', FILTER_VALIDATE_INT);
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->repository->find($id);
        }

        return new Response(200, body: $this->template->render('form', [
            'video' => $video,
        ]));
    }

    public function teste()
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->repository->find($id);
        }

        return new Response(200, body: $this->template->render('video-form', [
            'video' => $video,
        ]));
    }
}