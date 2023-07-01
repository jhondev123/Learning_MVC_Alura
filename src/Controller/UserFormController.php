<?php

namespace Jhonattan\MVC\Controller;

use ConnectionCreator;
use Jhonattan\MVC\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserFormController implements RequestHandlerInterface
{
    public function __construct()
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        require_once __DIR__ . "/../../views/user-form.php";

    }
}