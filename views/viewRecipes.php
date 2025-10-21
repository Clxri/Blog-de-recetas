<?php

class viewRecipes {
    public function showRecipes($recipes){
        $count = count($recipes);
        require './templates/templateRecipes.phtml';
    }

    public function showRecipeById($recipe,$user){
        require './templates/templateRecipeById.phtml';
    }

    public function addRecipe($recipe = null,$users ,$error = ''){
    require './templates/templateFormRecipe.phtml';
  }

}
?>