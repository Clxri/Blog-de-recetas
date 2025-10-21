<?php
require_once './config.php';
class modelUsers{
   private $db;
   public function __construct() {
    $this-> db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
   }


   public function showUsers(){
    $query = $this->db->prepare('SELECT * FROM users');
    $query->execute(); 
    $users = $query->fetchAll(PDO::FETCH_OBJ);
    return $users;
   }
    
   public function showUserById($id){
    $query = $this->db->prepare('SELECT * FROM users WHERE id_user = ?');
    $query->execute([$id]);
    $user = $query->fetch(PDO::FETCH_OBJ); // Retorna el usuario
    return $user; 
   }

   public function deleteUser($id){
    // Primero eliminar las recetas asociadas al usuario
    $query = $this->db->prepare('DELETE FROM recipes WHERE id_user = ?');
    $query->execute([$id]);
    // Después elimina el usuario
    $query = $this->db->prepare('DELETE FROM users WHERE id_user= ?');
    $query->execute([$id]); 
   } 

   public function createUser($name, $email, $description, $age){
    $query = $this->db->prepare('INSERT INTO users (name, email, description, age) VALUES (?, ?, ?, ?)');
    $query->execute([$name, $email, $description, $age]); 
   }

   public function updateUser($id_user, $name, $email, $description, $age){
    $query = $this->db->prepare('UPDATE users SET name = ?, email = ?, description = ?, age = ? WHERE id_user = ?');
    $query->execute([$name, $email, $description, $age, $id_user]);
   }

}