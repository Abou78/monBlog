<?php

use Exception\RouteNotFoundException;
use Exception\RouteNotAuthorizedException;
use Router\Router;

require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' 
. DIRECTORY_SEPARATOR);

session_start();

$router = new Router();

try {
   $router->register('/', ['Controller\HomeController', 'home'] );
   $router->register('/articles', ['Controller\PostController', 'create'] );
   $router->register('/listArticles', ['Controller\PostController', 'list'] );
   $router->register('/article', ['Controller\PostController', 'read'] );
   $router->register('/article/update', ['Controller\PostController', 'update'] );
   $router->register('/article/delete', ['Controller\PostController', 'delete'] );
   $router->register('/article/addComment', ['Controller\CommentController', 'create'] );
   $router->register('/login', ['Controller\UserController', 'login'] );
   $router->register('/logout', ['Controller\UserController', 'logout'] );
   $router->register('/registration', ['Controller\UserController', 'registration'] );
   $router->register('/administration', ['Controller\AdminController', 'commentToValidate'] );
   $router->register('/administration/update', ['Controller\AdminController', 'update'] );
} catch (RouteNotAuthorizedException $exception) {
   echo $exception->getMessage();
}

try {
   echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (RouteNotFoundException $exception) {
   echo $exception->getMessage();
}
