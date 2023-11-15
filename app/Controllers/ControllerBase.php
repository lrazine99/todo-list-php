<?php

namespace App\Controllers;

abstract class ControllerBase {

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
        //demarage de la session que si ce n'est pas le cas
        if(session_status() === PHP_SESSION_NONE){
            session_start();
            if (!isset($_SESSION['token'])) {
                //creation du token unique à chaque session 
                $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(6));
             }
            error_reporting(0);
            
        }
    }
    protected function view(string $path,  $params = null)
    {
        //mise en tampon des données pour pouvoir les transmettre dans une variable transmise 
        // à la vue layout

        ob_start();
        require VIEWS . $path . '.php';
        
        
        $content  = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    protected function isAdmin(){

        //vérification du role admin pour la session
        if(isset($_SESSION['auth']) && $_SESSION['auth'] ==='admin')
        {
            
            return true;

        }else{
            
            return header('Location: /');
        }

    }

        

        protected function form_chek( $PostValues)
        {
            //verification que le formulaire ne soit pas vide
            foreach ($PostValues as  $value) {
                if(!isset($value)){
                    return false;
                }else{
                    
                }
            }
            
            return true;

        }
}

?>