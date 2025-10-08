<?php
require_once './config.php';
class modelUsers{
    private $db;
    public function __construct() {
        $this-> db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }
}

public function showUsers(){
    $query = $this->db->prepare('SELECT * FROM users');
    $query->execute(); 
    $users = $query->fetchAll(PDO::FETCH_OBJ);
    return $users;
} 

public function showUsersById($id){
    $query = $this->db->prepare('SELECT * FROM command WHERE id_users = ?');
    $query->execute([$id]);
    $recipes = $query->fetch(PDO::FETCH_OBJ);
    return $recipes;
}

public function deleteUsers($id){
    $query = $this->db->prepare('DELETE FROM users WHERE id_users= ?');
    $query->execute([]); 
} 

public function createUsers($name, $email, $description, $age){
    $query = $this->db->prepare('INSERT INTO users (name, email, description, age) VALUES (?, ?, ?, ?)');
    $query->execute([$name, $email, $description, $age]); 
}

public function updateUsers($id_users, $name, $email, $description, $age){
    $query = $this->db->prepare('UPDATE users SET name = ?, email = ?, description = ?, age = ? WHERE id_users = ?');
    $query->execute([$id_users, $name, $email, $description, $age]); 
}
