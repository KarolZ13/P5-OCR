<?php

namespace Router;

class Router
{

    public $url;
    public $routes = [];
    public $matchFound = false;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                $this->matchFound = true; // Une route a été trouvée
                return $route->execute();
            }
        }
        if (!$this->matchFound) {
            return header('HTTP/1.0 404 Not Found');
        }
    }
}