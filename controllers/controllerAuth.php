<?php
require_once './views/viewAuth.php'; 

class controllerAuth{
    private $view;
    
    public function __construct() {
        $this->view = new viewAuth();
    }


    public function showInicio(){
        $this->view->showInicio();
    }

    public function showError(){
        $this->view->showError();
    }

    public function showLogIn(){
        $this->view->showLogIn();
    }

   // public function showLogOut() {
   //     session_start();
   //     session_destroy();
   //     header("Location: " . BASE_URL. 'home');
   // }
}
