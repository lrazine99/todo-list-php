<?php

namespace Router;

use Database\DBconnection;

class Route {

    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        //changement syntaxe pour comparaison avec un retour en boolean 
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";
        
        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }

    public function execute()
    {
        //deux données le nom de la class et sa methode
        $params = explode('@', $this->action);
        //instance du controller qui instancie lui meme le pdo pour la bdd
        $controller = new $params[0](new DBconnection(DB_name, DB_host, DB_username, DB_password));
        $method = $params[1];
        //conditon pour verifier une donnée en get à envoyer à la methode
        return isset($this->matches[1])  ? $controller->$method($this->matches[1]) : $controller->$method(); 
    }
}