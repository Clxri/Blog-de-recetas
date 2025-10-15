<?php
require_once './models/modelUsers.php';
require_once './views/viewUsers.php';

class controllerUsers {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new modelUsers();
        $this->view = new viewUsers();
    }

    // Mostrar todos los usuarios
    public function showUsers() {
     $users = $this->model->showUsers();
     $this->view->displayUsers($users);
    }

    // Mostrar un usuario por ID
    public function showUserById($id) {
        $user = $this->model->showUserById($id); 
        if ($user) {
            $this->view->displayUserDetail($user);
        } else {
            $this->view->showError("Usuario con ID no encontrado", 404); 
        }
    }

    // Crear un nuevo usuario
    public function createUser() {
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['age'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $description = $_POST['description'] ?? '';
            $age = $_POST['age'];

            $this->model->createUser($name, $email, $description, $age);
            header("Location: " . BASE_URL . "showUsers");
        } else {
            $this->view->showError("Faltan completar datos del usuario.");
        }
    }

    // Eliminar un usuario
    public function deleteUser($id) {
        $this->model->deleteUser($id);
        header("Location: " . BASE_URL . "showUsers");
    }

    // Editar usuario
    public function updateUser($id) {
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['age'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $description = $_POST['description'] ?? '';
            $age = $_POST['age'];

            $this->model->updateUser($id, $name, $email, $description, $age);
            header("Location: " . BASE_URL . "showUsers");
        } else {
            $this->view->showError("Faltan completar campos");
        }
    }
}
?>