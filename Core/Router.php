<?php

namespace Core;

class Router
{

    protected $routes = [];

    public function add($method, $uri, $action)
    {
        return $this->routes[] = [
            'uri' => $uri,
            'controller' => is_array($action) ? $action[0] : null,
            'action' => is_array($action) ? $action[1] : $action,
            'method' => $method
        ];
    }

    public function get($uri, $action)
    {
        $this->add('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->add('POST', $uri, $action);
    }

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
                if ($route['controller'])
                    return (new $route['controller'])->{$route['action']}();
                else
                    call_user_func($route['action']);
            }
        }

        return abort(404);
    }
}
