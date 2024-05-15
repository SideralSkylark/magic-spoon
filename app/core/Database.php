<?php

namespace app\core;

use \PDO;
use \PDOException;

class Database {

   private $host = 'localhost';
   private $dbname = 'magic_spoon';
   private $username = 'root';
   private $password = '';
   private $pdo;

   public function __construct() {
      try {
         $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //echo "connected";
      } catch (PDOException $e) {
         //echo "failed connection". 
         $e->getMessage();
      }
   }

   public function getPDO(): PDO {
      return $this->pdo;
   }
}