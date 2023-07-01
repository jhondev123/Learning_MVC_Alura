<?php

namespace Jhonattan\MVC\Controller;
require_once __DIR__ . '/../../connectionCreator.php';

use Jhonattan\MVC\Helper\HtmlRenderererTrait;
use Jhonattan\MVC\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class VideoListController  implements RequestHandlerInterface
{
    use HtmlRenderererTrait;
    public function __construct(private VideoRepository $videoRepository, private Engine $template)
    {
    }

    public function handle(ServerRequestInterface $request):ResponseInterface
    {

        $videoList = $this->videoRepository->all();
       return new Response( 200,[],$this->template->render( 'video-list',
        ['videoList'=>$videoList]));
    }
}

