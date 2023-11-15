<?php

namespace App\Model;

use PDO;

class User extends model{

   
    //requête de la ligne pour le login
    public function getUsername(string $param)  
    {
        $request = $this->db->getPdo()->prepare("SELECT * FROM user WHERE username=  ? ");
        $request->execute([$param]);
        return $request->fetch();
    }
}