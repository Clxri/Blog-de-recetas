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
}
