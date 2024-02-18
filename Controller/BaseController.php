<?php

namespace Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    public function render(string $template, ?array $variables = []): string
    {
        $loader = new FilesystemLoader(__DIR__ . '/../view');
        $twig = new Environment($loader, [
            'debug' => true,
         ]);
         $twig->addExtension(new DebugExtension());
         $twig->addGlobal('app', [
            'session' => $_SESSION
        ]);

        return $twig->render($template, $variables);
    }
}