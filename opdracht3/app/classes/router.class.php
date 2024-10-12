<?php
class Router {
    private $routes = [];

    // Method to register a route
    public function addRoute($path, $callback) {
        $this->routes[$path] = $callback;
    }

    // Method to execute the route based on the request
    public function run($path) {
        if (array_key_exists($path, $this->routes)) {
            call_user_func($this->routes[$path]);
        } else {
            // Show 404 if route not found
            include 'app/views/404.view.php';
        }
    }
}
