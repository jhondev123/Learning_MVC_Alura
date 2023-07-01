<?php

namespace Jhonattan\MVC\Controller;

abstract class ControllerWithHTML implements Controller
{
    private const TEMPLATEPATH = __DIR__ . "/../../views/";
    protected function renderTemplate(string $templateName, array $context = []):string
    {

        extract($context);
        ob_start();
        require_once self::TEMPLATEPATH . $templateName . '.php';
        return ob_get_clean();

    }

}