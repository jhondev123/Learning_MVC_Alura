<?php

namespace Jhonattan\MVC\Controller;

class Error404Controller implements Controller
{
    public function processaRequisicao():void
    {
        http_response_code(404);
    }

}