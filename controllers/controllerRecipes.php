<?php
require_once './views/viewRecipes.php'; 
require_once './models/modelRecipes.php';

class controllerRecipes{
    private $view;
    private $model;
    
    public function __construct() {
        $this->view = new viewRecipes();
        $this->model = new modelRecipes();
    }

    public function showRecipes(){
      // obtengo las tareas de la DB
      $recipes = $this->model->showRecipes();
      // mando las tareas a la vista
      $this->view->showRecipes($recipes);
    }

    public function showRecipeById($id){
        $recipe = $this->model->showRecipeById($id); 
        if ($recipe) {
            $this->view->showRecipes($recipe);
        } else {
            $this->view->showError("Receta con ID no encontrado", 404); 
        }
    }

    public function deleteRecipe($id){
        $this->model->deleteRecipe($id);
        header("Location: " . BASE_URL . "showRecipes");
    }

    public function updateRecipe($id){
        if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['time']) && !empty($_POST['date'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $time = $_POST['time'] ?? '';
            $date = $_POST['date'];
        $this->model->updateRecipe($id, $title, $content, $time, $date);
            header("Location: " . BASE_URL . "showRecipes");
        } else {
            $this->view->showError("Faltan completar campos");
        }
    }

    public function createRecipe(){
        if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['time']) && !empty($_POST['date'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $time = $_POST['time'] ?? '';
            $date = $_POST['date'];

            $this->model->createRecipe($title, $content, $time, $date);
            header("Location: " . BASE_URL . "showRecipes");
        } else {
            $this->view->showError("Faltan completar datos del usuario.");
        }
    }


}
