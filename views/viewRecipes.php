<?php

class viewRecipes {
    public function showRecipes($recipes){
        $count = count($recipes);
        require './templates/templateRecipes.phtml';
    }

}
?>