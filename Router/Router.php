<?php

namespace Router;

use Exception\RouteNotFoundException;

class Router
{

    private array $routes;

    public function register(string $path, array $action): void
    {
        $this->routes[$path] = $action;
    }


    public function resolve(string $uri): mixed
    {

        $path = explode('?', $uri)[0];

        $action = $this->routes[$path] ?? null;

        if (is_array($action)) {
            [$className, $method] = $action;

            if (class_exists($className) && method_exists($className, $method)) {
                $class = new $className();
                
                return call_user_func_array([$class, $method], []);
            } //end if().

        } //end if().
        
        throw new RouteNotFoundException();
    }
}
