<?php

use Exceptions\RouteNotFoundException;
use Router\Router;

require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' 
. DIRECTORY_SEPARATOR);
 
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new Twig\Environment($loader);

$router = new Router($twig);

$router->register('/', ['Controllers\MainController', 'home'] );

$router->register('/articles', ['Controllers\MainController', 'articles'] );

try {
   echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (RouteNotFoundException $e){
   echo $e->getMessage();
}


