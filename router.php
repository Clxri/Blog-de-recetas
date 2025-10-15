<?php
require_once './controllers/controllerRecipes.php';
require_once './controllers/controllerUsers.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
switch ($params[0]) {
    case "home": //por defecto
        $controller = new controllerRecipes;
        $controller->showInicio(); //tengo que hacerlo
        break;
    
    case "showRecipes": //muestro todas
        $controller = new controllerRecipes; //lamo a controller de recipes
        $controller->showRecipes(); //llamo a funcion especifica
        break;

    case "showRecipeById": //muestro receta por id
        $controller = new controllerRecipes;
        $controller->showRecipeById($params[1]);
        break;

    case "deleteRecipe":
        $controller = new controllerRecipes;
        $controller->deleteRecipe($params[1]);
        break;
    
    case "updateRecipe":
        $controller = new controllerRecipes;
        $controller->updateRecipe($params[1]);
        break;

    case "createRecipe":
        //form
        break;

    default: //en caso de que no sea ninguna muestro error
        echo ("Error")
        break;
}
    