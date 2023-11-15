<?php

namespace App\Model;

use PDO;


class model{

    // instance de pdo
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    // ensemble des requêtes
    public function findAll(string $table)
    {
        $request = $this->db->getPdo()->query("SELECT * FROM {$table} ");
        return  $request->fetchAll();
    }

    public function findAllBy($table, int $id)
    {
        $request = $this->db->getPdo()->prepare("SELECT * FROM  {$table} WHERE idCategorie = ?");
        $request->execute([$id]);
        return  $request->fetchAll();
    }

    public function findOneBy(string $table,  $nameparam,  $param)
    {
        $request = $this->db->getPdo()->prepare("SELECT * FROM {$table} WHERE  {$nameparam} =  ?");
        $request->execute([$param]);
        return $request->fetch();
    }

    public function deleteOneBy(string $table,  $nameparam,  $param)
    {
        $request = $this->db->getPdo()->prepare("DELETE FROM {$table} WHERE {$nameparam}=  ?");
        $request->execute([$param]);
        
    }

    public function deleteAll(string $table)
    {
        $request = $this->db->getPdo()->prepare("TRUNCATE TABLE {$table}");
        $request->execute();
          
    }

    
    public function updateCategorie(string $table, string $categorie, int $id)
    {
        $request = $this->db->getPdo()->prepare("UPDATE {$table} SET categorie= ? WHERE idCategorie= ?");
        $request->execute([$categorie, $id]);
  
    }

    public function finishItem(int $id)
    {
        $request = $this->db->getPdo()->prepare("UPDATE list SET etat= 'terminée' WHERE idList= ?");
        $request->execute([$id]);
  
    }

    public function updateItem(string $tache, string $etat, string $idCategorie, int $idList)
    {

        $request = $this->db->getPdo()->prepare("UPDATE list SET tache= ?, etat= ?, idCategorie= ? WHERE idList= ?");
        $request->execute([$tache,  $etat,  $idCategorie,  $idList]);
        
          
    }

    public function addItem(string $tache, int $idC)
    {
        $request = $this->db->getPdo()->prepare("INSERT into list (tache, idCategorie) 
        VALUES (:tache, :idCategorie)");
        $idC = (int)$idC;
        
        $request->execute(['tache' => $tache, 'idCategorie' =>$idC]);
         
    }

    public function addCategorie(string $categorie)
    {
        $request = $this->db->getPdo()->prepare("INSERT into categorie (categorie) 
        VALUES (:categorie)");
        
        $request->execute(['categorie' =>$categorie]);
         
    }

    public function delete(string $table, string $column, $value)
    {
        $request = $this->db->getPdo()->prepare("DELETE  from list WHERE {$column}= ?");
        
        
        $request->execute([ $value]);
       
    }
    public function delete2(int $value1, string $value2)
    {
        $request = $this->db->getPdo()->prepare("DELETE  from list WHERE idCategorie= ? AND etat= ?");
        
        
        $request->execute([ $value1, $value2]);
       
    }

    

    
}