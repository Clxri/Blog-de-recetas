<?php
require_once './views/viewAuth.php'; 
require_once './models/modelAuth.php';

class controllerAuth{
    private $view;
    private $model;
    
    public function __construct() {
        $this->view = new viewAuth();
        $this->model = new authModel();
    }


    public function showInicio(){
        $this->view->showInicio();
    }


    public function showLogIn(){
        $this->view->showLogIn();
    }

    public function logIn(){
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
         return $this->view->showLogIn('Por favor ingrese usuario y contraseña');
        }

       $username = $_POST['username'];
       $password = $_POST['password'];

       $userDb = $this->model->getUserByUsername($username);
      
        if (!$userDb) {
         return $this->view->showLogIn('El usuario no existe');
        }

        // 
        if (password_verify($password, $userDb->password)) {
         session_start();
         $_SESSION['ID_USER'] = $userDb->id;
         $_SESSION['USERNAME'] = $userDb->username;
         $_SESSION['IS_LOGGED'] = true;

         header("Location: " . BASE_URL . "showUsers");
         } else {
         return $this->view->showLogIn('Contraseña incorrecta..');
        }    
    }


    public function showError(){
        $this->view->showError();
    }
    


    public function logOut() {
         session_start();
         session_destroy();
        header("Location: " . BASE_URL. 'home');
   }
}
