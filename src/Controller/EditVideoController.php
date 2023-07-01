<?php

namespace Jhonattan\MVC\Controller;
use finfo;
use Jhonattan\MVC\Entity\Video;
use Jhonattan\MVC\Helper\FlashMessageTrait;
use Jhonattan\MVC\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {

    }

public function handle(ServerRequestInterface $request):ResponseInterface
        {
            $queryParamsGet = $request->getQueryParams();
            $queryParamsPost = $request->getParsedBody();

            $id = filter_var($queryParamsGet['id'], FILTER_VALIDATE_INT);
            if ($id === false) {
                $this->addErrorMessage("Erro no ID");
                return new Response(302, [
                    "location" => '/'
                ]);
            }

            $url = filter_var($queryParamsPost['url'], FILTER_VALIDATE_URL);
            if ($url === false) {
                $this->addErrorMessage("Url não informada");
                return new Response(302, [
                    "location" => '/'
                ]);
            }
            $titulo = filter_input(INPUT_POST, 'titulo');
            if ($titulo === false) {
                $this->addErrorMessage("Titulo não informado");
                return new Response(302, [
                    "location" => '/'
                ]);
            }

            $video = new Video($url,$titulo);
            $video->setId($id);
            $files = $request->getUploadedFiles();
            /** @var UploadedFileInterface $uploadImage */
            $uploadImage = $files['image'];

            if($uploadImage->getError() === UPLOAD_ERR_OK){
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $tmpFile = $uploadImage->getStream()->getMetadata('uri');

                $mineType = $finfo->file($tmpFile);

                if(str_starts_with($mineType,"image/")){
                    $safeFileName = uniqid('upload_') . "_". pathinfo($uploadImage->getClientFilename(),PATHINFO_BASENAME);
                    $uploadImage->moveTo(__DIR__ . '/../../public/img/uploads/' . $safeFileName);
                $video->setFilePath($safeFileName);
                }
            }
            $sucess = $this->videoRepository->updateVideo($video);
            if($sucess === false){
                $this->addErrorMessage("Erro ao editar video");
                return new Response(302, [
                    "location" => '/'
                ]);
            }else{
                return new Response(302, [
                    "location" => '/'
                ]);
            }

        }

    }
