<?php

namespace Jhonattan\MVC\Controller;

class LogoutController implements Controller
{

    public function processaRequisicao(): void
    {
        if($_SESSION['logado']===true){
            session_destroy();
            header("location: /");
        }else{
            header("location: /login");
        }
    }
}