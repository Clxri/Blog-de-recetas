<?php

class helperAuth {

function verifySession($res){
        session_start(); //lee si hay una cookie
        if(isset($_SESSION['ID_USER'])){ //si esta seteado el id
            $res->user = new stdClass(); // en el objeto response guarda los datos de usuario
            $res->user->id = $_SESSION['ID_USER'];
            $res->user->username = $_SESSION['USERNAME'];
            return;
        } else {
            header('Location: ' . BASE_URL . 'showLogIn'); //sino redirije log in 
        }
    }

}