<?php
require_once './views/viewRecipes.php'; 
require_once './views/viewAuth.php';
require_once './models/modelRecipes.php';
require_once './models/modelUsers.php';

class controllerRecipes {
    private $view;
    private $model;
    private $modelUser;
    private $viewAuth;
    
    public function __construct() {
        $this->view = new viewRecipes();
        $this->viewAuth = new viewAuth();
        $this->model = new modelRecipes();
        $this->modelUser = new modelUsers();
    }

    public function showRecipes(){
      $recipes = $this->model->showRecipes();
      $this->view->showRecipes($recipes);
    }

    public function showRecipeById($id) {
        $recipe = $this->model->showRecipeById($id); 
        if ($recipe) {
            $user = $this->modelUser->showUserById($recipe->id_user);
            $this->view->showRecipeById($recipe,$user);
        } else {
            $this->viewAuth->showError(); 
        }
    }

    public function deleteRecipe($id){
        $this->model->deleteRecipe($id);
        header("Location: " . BASE_URL . "showRecipes");
    }

    public function showRecipeForm($id = null) {
        $recipe = null;
            if ($id) {
            // si hay id cargado voy al modelo a buscar los datos
            $recipe = $this->model->showRecipeById($id); // traigo receta con el id especifico
        }
            $users = $this->modelUser->showUsers();  //traigo la info del usuario para mostrarlo
            return $this->view->addRecipe($recipe,$users); //te devuelve la vista dependiendo la info
    }

    
    public function modifyRecipe($id){
        if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['time']) && !empty($_POST['date']) && !empty($_POST['id_user'])) {

        $title = $_POST['title'];
        $content = $_POST['content'];
        $time = $_POST['time'] ?? '';
        $date = $_POST['date'];
        $id_user = $_POST['id_user'];

        // para ver si hay img cargada
        $img = null;
        if (isset($_FILES['input_name']) && $_FILES['input_name']['tmp_name'] != '') {
            $type = $_FILES['input_name']['type'];
                if ($type == "image/jpg" || $type == "image/jpeg" || $type == "image/png") {
                    $img = $_FILES['input_name'];
                }
        }

    
        $this->model->modifyRecipe($id, $title, $content, $time, $date, $id_user, $img);

        header("Location: " . BASE_URL . "showRecipes");

        } else {
                $this->viewAuth->showError("Faltan completar campos");
                }
    }

    
    
    public function newRecipe(){
        if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['time']) && !empty($_POST['date']) && !empty($_POST['id_user'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $time = $_POST['time'] ?? '';
            $date = $_POST['date'];
            $id_user = $_POST['id_user'];

        if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" 
                    || $_FILES['input_name']['type'] == "image/png" ) {
                    $this->model->newRecipe($title, $content, $time, $date, $id_user, $_FILES['input_name']);
                }
            header("Location: " . BASE_URL . "showRecipes");
        } else {
            $this->viewAuth->showError("Faltan completar datos");
        }
    }
    }


