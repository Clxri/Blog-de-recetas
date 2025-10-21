<?php

class viewUsers {
    public function displayUsers($users){
        $count = count($users);
        require './templates/templateUsers.phtml';
    }

    public function displayUserDetail($user){
        require './templates/templateUserDetail.phtml';
    }
    
    public function addUserForm($user = null, $error = '') {
     require './templates/templateFormUser.phtml'; 
    }

    public function showError($message, $code = null) {
    echo "<div class='alert alert-danger' role='alert'>
        <h4>Error</h4>
        <p>$message</p>
        </div>";
    }


}
?>
