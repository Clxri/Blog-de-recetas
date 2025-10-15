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
        //mostrar receta por id usuario?
        $query = $this->db->prepare('SELECT * FROM recipes WHERE id_recipe = ? ORDER BY id_recipe ASC');
        $query->execute([$id]);

        $recipes = $query->fetchAll(PDO::FETCH_OBJ);
        return $recipes;
    }

    public function deleteRecipe($id){

        $query = $this->db->prepare('DELETE FROM recipes WHERE id_user = ? '); //chequear esto
        $query->execute([$id]);
    }

    public function createRecipe($title,$content,$time,$date,$id_user){

        $query = $this->db->prepare('INSERT INTO recipes(title, content, time, date, id_user) VALUES (?,?,?,?,?)');
        $query->execute([$title, $content, $time, $date, $id_user]);
        // return $this->db->lastInsertId() por las dudas, y chequear opcionales! tiene que tener 
    }

    public function updateRecipe($id_recipe,$title,$content,$time,$date,$id_user){

        $query = $this->db->prepare('UPDATE recipes SET title = ?, content = ?, time = ?, date = ?, id_user = ? WHERE id_recipe = ?');
        $query->execute([$title,$content,$time,$date,$id_user,$id_recipe]);
    }




}