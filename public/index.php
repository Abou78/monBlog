<?php

use Controller\BaseController;
use Exception\RouteNotFoundException;
use Router\Router;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' 
. DIRECTORY_SEPARATOR);

$router = new Router();

$router->register('/', ['Controller\HomeController', 'home'] );
$router->register('/articles', ['Controller\PostController', 'create'] );
$router->register('/listArticles', ['Controller\PostController', 'list'] );
$router->register('/article', ['Controller\PostController', 'read'] );
$router->register('/article/update', ['Controller\PostController', 'update'] );
$router->register('/article/delete', ['Controller\PostController', 'delete'] );

try {
   echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (RouteNotFoundException $exception) {
   echo $exception->getMessage();
}
