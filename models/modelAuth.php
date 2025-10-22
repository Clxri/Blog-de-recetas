<?php
require_once './config.php';

class authModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', 
            MYSQL_USER, 
            MYSQL_PASS
        );
    }

    // Buscar usuario por username
   public function getUserByUsername($username) {
     $query = $this->db->prepare('SELECT * FROM `admin` WHERE username = ?');
     $query->execute([$username]);
     $user = $query->fetch(PDO::FETCH_OBJ);
     return $user;
    }
}
