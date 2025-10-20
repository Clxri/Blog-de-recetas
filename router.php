<?php
require_once './controllers/controllerRecipes.php';
require_once './controllers/controllerUsers.php';
require_once './controllers/controllerAuth.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
switch ($params[0]) {
    case "home": 
        $controller = new controllerAuth();
        $controller->showInicio(); 
        break;
    
    case "showRecipes": 
        $controller = new controllerRecipes(); 
        $controller->showRecipes(); 
        break;

    case "showRecipeById": //muestro receta por id
        $controller = new controllerRecipes();
        $controller->showRecipeById($params[1]);
        break;

    case "deleteRecipe":
        $controller = new controllerRecipes();
        $controller->deleteRecipe($params[1]);
        break;
    
    case "updateRecipe":
        $controller = new controllerRecipes();
        $controller->updateRecipe($params[1]);
        break;

    case "createRecipe":
        $controller = new controllerRecipes();
        $controller->createRecipe();
        break;
    
    //Muestra todos
    case "showUsers": 
        $controller = new controllerUsers (); 
        $controller->showUsers(); 
        break;

    case "showUserById": 
        $controller = new controllerUsers();
        $controller->showUserById($params[1]);
        break;

    case "deleteUser":
        $controller = new controllerUsers();
        $controller->deleteUser($params[1]);
        break;

    // Mostrar formulario para editar
    case "editUser":
      $controller = new controllerUsers();
      $controller->editUserForm($params[1]);
      break;
    
    // Guardar cambios de usuario 
    case "updateUser":
        $controller = new controllerUsers();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->updateUser($params[1]);
    } else {
        $controller->editUserForm($params[1]);
        break;
        
    }
    case "createUser":
        $controller = new controllerUsers();
        $controller->createUser();
        break;

    case "addUser":
        $controller = new controllerUsers();
        $controller->addUserForm();
        break;


    default: //en caso de que no sea ninguna muestro error
        echo ("Error");
        break;
}
    