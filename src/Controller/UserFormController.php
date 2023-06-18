<?php

namespace Jhonattan\MVC\Controller;

use ConnectionCreator;
use Jhonattan\MVC\Repository\UserRepository;

class UserFormController implements Controller
{
    public function __construct()
    {

    }

    public function processaRequisicao(): void
    {
        require_once __DIR__ . "/../../views/user-form.php";

    }
}