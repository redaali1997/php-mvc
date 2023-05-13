<?php

namespace Core;

class Router
{

    protected $routes = [];

    public function add($method, $uri, $controller, $action)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'method' => $method
        ];
    }

    public function get($uri, $action)
    {
        if (is_array($action))
            $this->add('GET', $uri, $action[0], $action[1]);
    }

    // public function post($uri, $controller)
    // {
    //     $this->add('POST', $uri, $controller);
    // }

    // public function delete($uri, $controller)
    // {
    //     $this->add('DELETE', $uri, $controller);
    // }

    // public function patch($uri, $controller)
    // {
    //     $this->add('PATCH', $uri, $controller);
    // }

    // public function put($uri, $controller)
    // {
    //     $this->add('PUT', $uri, $controller);
    // }

    public function route($uri, $method)
    {

        foreach ($this->routes as $route) {
            if ($uri === $route['uri'] && strtoupper($method) === $route['method']) {
                return (new $route['controller'])->{$route['action']}();
            }
        }

        return abort(404);
    }
}
