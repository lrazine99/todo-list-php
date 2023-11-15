<?php

namespace App\Controllers;


use App\Model\User;

class UserController extends ControllerBase {

    

    public function login(){
        //systeme à deux numeros pour enlever la variable en session qui affiche l'erreur au refresh 
        $_SESSION['num1'] +=1;
        if($_SESSION['num1'] > $_SESSION['num2'] ){

            session_unset();
        }
        

        return $this->view('login', );

    }

    public function loginPost(){

        $user = new User($this->db);
        $username = $_POST['username'];
        $result = $user->getUsername($username);
        //instance de user avec la requête pour recupérer la ligne avec le username
        //si username est recupérer verification du mdp en hash
        if (password_verify($_POST['password'], $result['password'])) {
            $_SESSION['auth'] = $result['role'];
            //comparaison du role assigne lor la session_start()
            return header('Location: /list');
        }else{
            //variable d'erreur
            $_SESSION['num2'] +=1;
            $_SESSION['error'] = 'invalid credentials';
            
            return header('Location: /');
            
        }   
        
    }

    public function logout(){
        session_unset();
        session_destroy();
        return header('Location: /');
    }


}