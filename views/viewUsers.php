<?php

class viewUsers {

    // Muestra el listado completo de usuarios
    public function displayUsers($users) {
        require './templates/templateUsers.phtml';
    }

    // Muestra el detalle de un usuario individual
    public function displayUserDetail($user) {
        require './templates/templateUserDetail.phtml';
    }

}
?>
