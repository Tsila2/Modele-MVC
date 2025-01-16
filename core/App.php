<?php

namespace Core;

class App
{
    protected $controller = 'HomeController'; // Default controller
    protected $method = 'index';              // Default method
    protected $params = [];                   // Default parameters
    protected $routes;                        // Routes object

    public function __construct()
    {
        // Load routes using the Route class
        $this->routes = $this->loadRoutes();

        // Parse the URL
        $url = $this->parseUrl();
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Match the URL and HTTP method against the routes
        $route = $this->matchRoute($url, $requestMethod);

        if ($route) {
            [$controllerName, $methodName] = explode('/', $route['action']);

            // Update controller and method
            $this->controller = ucfirst(strtolower($controllerName)) . 'Controller';
            $this->method = $methodName;

            // Extract parameters if dynamic placeholders are used
            $this->params = $route['params'];
        } else {
            // If no route match, fallback to default behavior
            $this->defaultRoute($url);
        }

        // Load and initialize the controller
        $this->initializeController();

        // Call the controller method with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Parse URL into an array of segments
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    // Load the routes using the Route class
    private function loadRoutes()
    {
        $routesFile = '../app/routes.php';
        if (file_exists($routesFile)) {
            return include($routesFile); // Expecting a Route object
        }
        die("Routes file '{$routesFile}' not found.");
    }

    // Match the URL and HTTP method against defined routes
    private function matchRoute($url, $method)
    {
        $urlPath = implode('/', $url); // Convert URL array back to string
        $allRoutes = $this->routes->all();

        if (isset($allRoutes[$method])) {
            foreach ($allRoutes[$method] as $route => $action) {
                $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_-]+)', $route);

                if (preg_match("#^{$pattern}$#", $urlPath, $matches)) {
                    array_shift($matches); // Remove full match
                    return [
                        'action' => $action,
                        'params' => $matches,
                    ];
                }
            }
        }
        return null;
    }

    // Fallback to default route handling
    private function defaultRoute($url)
    {
        if (!empty($url)) {
            $controllerName = ucfirst(strtolower($url[0])) . 'Controller';

            if (file_exists("../app/controllers/{$controllerName}.php")) {
                $this->controller = $controllerName;
                array_shift($url); // Remove the controller part from the URL
            }

            if (!empty($url)) {
                $this->method = $url[0];
                array_shift($url); // Remove the method part from the URL
            }

            $this->params = $url;
        }
    }

    // Initialize the controller and check for errors
    private function initializeController()
    {
        $controllerName = $this->controller;
        $controllerPath = "../app/controllers/{$this->controller}.php";

        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $controllerClass = "App\\Controllers\\{$this->controller}";

            if (class_exists($controllerClass)) {
                $this->controller = new $controllerClass();
            } else {
                die("Controller class '{$controllerClass}' not found.");
            }
        } else {
            die("Controller file '{$controllerPath}' not found.");
        }

        if (!method_exists($this->controller, $this->method)) {
            die("Method '{$this->method}' not found in '{$controllerName}'.");
        }
    }
}
