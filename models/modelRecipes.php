<?php
require_once './config.php';

class modelRecipes {
    private $db;

    public function __construct() {
        $this-> db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    public function showRecipes(){

        $query = $this->db->prepare('SELECT * FROM recipes');
        $query->execute();
        $recipes = $query->fetchAll(PDO::FETCH_OBJ);
        return $recipes;
    }

     public function showRecipeById($id){
        $query = $this->db->prepare('SELECT * FROM recipes WHERE id_recipe = ? ORDER BY id_recipe ASC');
        $query->execute([$id]);

        $recipes = $query->fetch(PDO::FETCH_OBJ);
        return $recipes;
    }

    public function deleteRecipe($id){
        $query = $this->db->prepare('DELETE FROM recipes WHERE id_recipe = ? '); 
        $query->execute([$id]); 

        $recipes = $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function newRecipe($title,$content,$time,$date,$id_user,$img){
        $pathImg = $this->uploadImage($img);
        $query = $this->db->prepare('INSERT INTO recipes(title, content, time, date, id_user, img) VALUES (?,?,?,?,?,?)');
        $query->execute([$title, $content, $time, $date, $id_user,$pathImg]);
        return $this->db->lastInsertId();  
    }

    private function uploadImage($img){
        $filePath = 'img/' .  uniqid("", true) . "." 
        . strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        move_uploaded_file($img["tmp_name"], $filePath);
        return $filePath; // Devuelve la ruta que se puede guardar en la DB
    }


    public function modifyRecipe($id_recipe,$title,$content,$time,$date,$id_user,$img = null){
         if($img && $img['tmp_name'] != ''){
            $pathImg = $this->uploadImage($img);
            $query = $this->db->prepare('UPDATE recipes SET title = ?, content = ?, time = ?, date = ?, id_user = ?, img = ? WHERE id_recipe = ?');
            $query->execute([$title, $content, $time, $date, $id_user, $pathImg, $id_recipe]);
        } else {
        // si no hay tal img que se actualice lo demás
        $query = $this->db->prepare('UPDATE recipes SET title = ?, content = ?, time = ?, date = ?, id_user = ? WHERE id_recipe = ?');
        $query->execute([$title, $content, $time, $date, $id_user, $id_recipe]);
    }
}




}