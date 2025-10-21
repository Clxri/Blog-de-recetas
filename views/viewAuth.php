<?php

class viewAuth {
    public function showInicio(){
        require './templates/templateInicio.phtml';
    }

    public function showError(){
        require './templates/templateError.phtml';
    }

    public function showLogIn(){
        require './templates/templateLogIn.phtml';
    }
}
?>