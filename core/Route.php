<?php

namespace Core;

class Route
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    public function delete($uri, $action)
    {
        $this->addRoute('DELETE', $uri, $action);
    }

    public function put($uri, $action)
    {
        $this->addRoute('PUT', $uri, $action);
    }

    public function all()
    {
        return $this->routes;
    }

    private function addRoute($method, $uri, $action)
    {
        $uri = trim($uri, '/');
        $this->routes[$method][$uri] = $action;
    }
}
