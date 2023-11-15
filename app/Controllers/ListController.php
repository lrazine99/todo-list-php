<?php

namespace App\Controllers;

use App\Model\model;
// class qui herite du controlerbase 
class ListController extends ControllerBase {

    
    
//ensemble des fonctions à chaque fois une méthode du controler parent est isAdmin() elle permet de verifier
// le bon role pour donner l'accès
    public function showCategorie()
    {
        $this->isAdmin();
        
        $request = new model($this->db);
        $resultCategorie = $request->findAll('categorie');
        
        return $this->view('categorie', array($resultCategorie));
    }

    public function show()
    {
        $this->isAdmin();
        $request = new model($this->db);
        $resultList = $request->findAll('list');
        $resultCategorie = $request->findAll('categorie');
        
        
        return $this->view('todolist', array($resultList, $resultCategorie));
    }


    public function editCategorie( $id)
    {
        $this->isAdmin();
        $get = explode('|', $id);
        if($get[1]  === $_SESSION['token']){

            $request = new model($this->db);
            $result = $request->findOneBy('categorie', 'idCategorie' ,$get[0]);
        }
        
        
        return $this->view('modifier', array($result));

    }

    
    public function updateCategorie(int $id)
    {
        $this->isAdmin();
        $request = new model($this->db);
        
        if($this->form_chek($_POST)){
            if($_POST['token'] === $_SESSION['token']){
                array_map('htmlspecialchars', $_POST);
                $request->updateCategorie('categorie', $_POST['categorie'], $id);
            }
        }
        header('Location: /list/categorie');
    }

    public function editItem($id)
    {
        $this->isAdmin();
        $request = new model($this->db);
        $get = explode('|', $id);
        if($get[1]  === $_SESSION['token']){
            $result = $request->findOneBy('list', 'idList' , $get[0]);
            $resultCategorie = $request->findAll('categorie');
        }
        
        return $this->view('modifier', array($result, $resultCategorie));

    }

    public function finishItem( $id)
    {
        $this->isAdmin();
        $get = explode('|', $id);
        if($get[1]  === $_SESSION['token']){
            $request = new model($this->db);
            $request->finishItem($get[0]);
        }
        
        header('Location: /list');

    }


    
    public function updateItem(int $id)
    {
        $this->isAdmin();
        $request = new model($this->db);
        if($this->form_chek($_POST)){
            if($_POST['token']  === $_SESSION['token']){
            array_map('htmlspecialchars', $_POST);
            $request->updateItem( $_POST['tache'], $_POST['etat'], $_POST['idCategorie'], $id);
            }
        }
        header('Location: /list');
    }

    public function addItem()
    {
        $this->isAdmin();
        $request = new model($this->db);
        if($this->form_chek($_POST)){
            if($_POST['token']  === $_SESSION['token']){
            array_map('htmlspecialchars', $_POST);
            $request->addItem($_POST['tache'], $_POST['idCategorie']);
            }
        }
        header('Location: /list');
    }

    public function addCategorie()
    {
        $this->isAdmin();
        
        $request = new model($this->db);
        if($this->form_chek($_POST)){
            if($_POST['token']  === $_SESSION['token']){
            array_map('htmlspecialchars', $_POST);
            $request->addCategorie($_POST['categorie']);
            }
        }
        header('Location: /list/categorie');
    }

    public function deleteItem( $id)
    {
        $this->isAdmin();
        $request = new model($this->db);
        $get = explode('|', $id);
        
            if($get[1]  === $_SESSION['token']){
            $request->deleteOneBy('list', 'idList', $get[0]);
            }
        
        
        header('Location: /list');
    }

    public function deleteCategorie( $id)
    {
        
        $this->isAdmin();
        
        $request = new model($this->db);
        $get = explode('|', $id);
        
            if($get[1]  === $_SESSION['token']){
                $result = $request->findAllBy('list', $get[0]);
            }
        
        if(count($result) == 0){

            
            $request->deleteOneBy('categorie', 'idCategorie', $id );
            header('Location: /list/categorie');
            
        }else{
            
            
            header('Location: /list/categorie');
            
        }

        
    }
    
    public function deleteItems( $param)
    {
        
        $this->isAdmin();
        $request = new model($this->db);
        $array = explode('|', $param);
        
        
        if($array[2]  === $_SESSION['token']){
                
            array_map('htmlspecialchars', $array);
            
        if(isset($array[0]) && isset($array[1]) )
        {
            if(($array[0] === 'undefined' || $array[0] ==='toute categorie') && ($array[1] === 'undefined' || $array[1] ==='état'))
            {
                $request->deleteAll( 'list');
                
            }else if(($array[0] === 'undefined' || $array[0] ==='toute categorie') || ($array[1] === 'undefined' || $array[1] ==='état'))
            {
                if($array[1] === 'undefined' || $array[1] ==='état')
                {
                    $request->delete('list', 'idCategorie', $array[0] );
                }
    
                if($array[0] === 'undefined' || $array[0] ==='toute categorie')
                {
                    $request->delete('list', 'etat', $array[1]  );
                }
            }else{

                $request->delete2($array[0] , $array[1] );

            }

        }
        }
        
        header('Location: /list');
    }
    
}