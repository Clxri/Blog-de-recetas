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
            $error = "Faltan completar datos del usuario.";
            $this->view->addUserForm(null, $error);
        }
    }

    // Eliminar un usuario
    public function deleteUser($id) {
        $this->model->deleteUser($id);
        header("Location: " . BASE_URL . "showUsers");
    }

    // Muestra formulario para editar un usuario existente
    public function editUserForm($id) {
     $user = $this->model->showUserById($id);
     if ($user) {
        $this->view->addUserForm($user);
     } else {
        $error = "El usuario no existe o fue eliminado.";
        $this->view->addUserForm(null, $error);
     }
}
    // Formulario para agregar o editar usuario
    public function addUserForm($user = null, $error = '') {
      $this->view->addUserForm($user, $error); // carga la vista del formulario
    }

    // Guardar cambios de usuario editado
    public function updateUser($id) {
      if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['age'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $description = $_POST['description'] ?? '';
        $age = $_POST['age'];

        $this->model->updateUser($id, $name, $email, $description, $age);
        header("Location: " . BASE_URL . "showUsers");
      } else {
        $error = "Faltan completar campos";
        $user = $this->model->showUserById($id);
        $this->view->addUserForm($user, $error);
      }
    }

    

}

?>