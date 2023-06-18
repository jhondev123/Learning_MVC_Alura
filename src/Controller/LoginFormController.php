<?php

namespace Jhonattan\MVC\Controller;

class LoginFormController implements Controller
{

    public function processaRequisicao(): void
    {
        if((['logado']  ?? false) === true){
            header("location: /");
            return;
        }
        require_once __DIR__ . "/../../views/loginForm.php";
    }
}