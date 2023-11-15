<?php

namespace Database;

use PDO;

class DBconnection{

    private $dbname;
    private $host;
    private $username;
    private $password;
    private $pdo;

    public function __construct(string $dbname, string $host, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPdo()
    {
        //objet pdo avec encodage et mode erreur
        $this->pdo = new PDO("mysql:dbname=".$this->dbname.";host=".$this->host, $this->username, $this->password,array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ));
        return $this->pdo;

    }
}