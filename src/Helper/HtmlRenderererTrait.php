<?php

namespace Jhonattan\MVC\Helper;

trait HtmlRenderererTrait
{

    private function renderTemplate(string $templateName, array $context = []):string
    {

        $templatePath = __DIR__ . "/../../views/";
        extract($context);
        ob_start();
        require_once $templatePath  . $templateName . '.php';
        return ob_get_clean();

    }
}