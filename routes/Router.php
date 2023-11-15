<?php

namespace Router;

use Router\Route;

class Router {

    public $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }
    // instance en get ou post de l'objet  
    public function get (string $path, string $action)
    {
        $this->routes['GET'][] = new  Route ($path, $action);
    }

    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }
   
    
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route ) {
            //apelle la methode match qui compare l'url qui retour true si l'url correspond
            // et execute l'appel du controler correspondont fournis dans $action
            if($route->matches($this->url)){
            return $route->execute();
          }
        }

        return header('HTTP/1.0 404 Not Found');
    }
    
}