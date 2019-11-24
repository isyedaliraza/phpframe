<?php
namespace App\Core;

class Router {
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function load($file) {
        $router = new self;
        require $file;
        return $router;
    }

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $method) {
        if (array_key_exists($uri, $this->routes[$method])) {
            return $this->callAction(
                ...explode('@', $this->routes[$method][$uri])
            );
        }
        
        throw new Exception('No route defined for this URI.');
    }

    protected function callAction($controller, $action) {
        $controller = "App\\Controllers\\{$controller}";
        $ctrl = new $controller;
        if (method_exists($ctrl, $action)) {
            return $ctrl->$action();
        }

        throw new Exception("{$controller} does not respond to {$action} action.");
    }
}