<?php

namespace Jhonattan\MVC\Controller;

use Jhonattan\MVC\Helper\HtmlRenderererTrait;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginFormController  implements RequestHandlerInterface
{
    use HtmlRenderererTrait;



    public function __construct( private Engine $templates)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if((['logado']  ?? false) === true){
            return new Response(302, [
                "location" => '/'
            ]);
        }
       return new Response(200,[],$this->templates->render("LoginForm"));
    }
}