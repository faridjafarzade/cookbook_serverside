<?php

if (isset($_GET['action'])) {
    include './autoload.php';

    $action = $_GET['action'];

    if ($action == 'get_page') {

        $pagination = new RecipePagination();

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {

            $pageNumber = Coder::code($_GET['page']);

            $pagination->setCurrentPage($pageNumber);
        }

        $page = $pagination->getPage();

        if ($page) {
            $error = FALSE;
            $http_status_codes = 200;
        } else {
            $error = TRUE;
            $http_status_codes = 404;
        }

        $info = array("api" => $_GET['action'], "error" => $error, "http_status_codes" => $http_status_codes, "page" => $page,);

        echo json_encode($info);
    } else if ($action == 'add' && isset($_GET['description']) && isset($_GET['title']) ) {

        $recipe = new CheckedRecipe(0, $_GET['title'], $_GET['description'], $_GET['image']);
        $pm = new RecipeMapper();
        $pro = $pm->save($recipe);

        if ($pro) {
            $error = FALSE;
            $http_status_codes = 201;
        } else {
            $error = TRUE;
            $http_status_codes = 400;
        }

        $info = array("api" => $_GET['action'], "error" => $error, "http_status_codes" => $http_status_codes, "recipe" => $pro);

        echo json_encode($info);
        
    } else if ($action == 'update' && isset($_GET['recipe_id']) ) {
        
        $recipe = new CheckedRecipe($_GET['recipe_id']);
        $pm = new RecipeMapper();
        if ($pm->isRecipe($recipe)) {

            if (isset($_GET['title']))
                $recipe->setTitle($_GET['title']);

            if (isset($_GET['description']))
                $recipe->setDescription($_GET['description']);

            if (isset($_GET['image']))
                $recipe->setImage($_GET['image']);

            $recipe->setDate(date("Y-m-d h:i:sa"));
            
            $pro = $pm->save($recipe);
        } else
            $pro = FALSE;

        if ($pro) {
            $error = FALSE;
            $http_status_codes = 201;
        } else {
            $error = TRUE;
            $http_status_codes = 400;
        }


        $info = array("api" => $_GET['action'], "error" => $error, "http_status_codes" => $http_status_codes, "recipe" => $pro);

        echo json_encode($info);
    } else if ($action == 'save') {

        $recipe = new CheckedRecipe();
        $pm = new RecipeMapper();

        if (isset($_GET['recipe_id']) && is_numeric($_GET['recipe_id']))
            $recipe->setId($_GET['recipe_id']);

        if (isset($_GET['title']))
                $recipe->setTitle($_GET['title']);

            if (isset($_GET['description']))
                $recipe->setDescription($_GET['description']);

            if (isset($_GET['image']))
                $recipe->setImage($_GET['image']);
            
            $recipe->setDate(date("Y-m-d h:i:sa"));

        $pro = $pm->save($recipe);

        if ($pro) {
            $error = FALSE;
            $http_status_codes = 201;
        } else {
            $error = TRUE;
            $http_status_codes = 400;
        }

        $info = array("api" => $_GET['action'], "error" => $error, "http_status_codes" => $http_status_codes, "recipe" => $pro);

        echo json_encode($info);
    } else if ($action == 'remove' && isset($_GET['recipe_id']) && is_numeric($_GET['recipe_id'])) {

        $recipeId = Coder::code($_GET['recipe_id']);

        $recipe = new CheckedRecipe($recipeId);

        $pm = new RecipeMapper();

        if ($pm->isRecipe($recipe)) {
            if ($pm->removeFromCards($recipe)) {
                $error = !$pm->remove($recipe);
                $http_status_codes = 201;
            } else {
                $error = TRUE;
                $http_status_codes = 304;
            }
        } else {
            $error = TRUE;
            $http_status_codes = 404;
        }

        $info = array("api" => $_GET['action'], "error" => $error, "http_status_codes" => $http_status_codes, "success" => !$error);

        echo json_encode($info);
    } else if ($action == 'save_rate' && isset($_GET['recipe_id']) && isset($_GET['positive']) && is_numeric($_GET['recipe_id'])&& isset($_GET['rate_id'])  && is_numeric($_GET['rate_id'])) {

        $recipeId = Coder::code($_GET['recipe_id']);
        $rateId = Coder::code($_GET['rate_id']);
        $positive = isset($_GET['positive']);
        $date = date("Y-m-d h:i:sa");
        $rate = new Rate($rateId,$_SERVER['REMOTE_ADDR'],$recipeId,$positive,$date);
        
        
        $rm = new RateMapper();

        if ($rm->save($rate) ){
            $error = FALSE;
                $http_status_codes = 201;
           
        } else {
            $error = TRUE;
            $http_status_codes = 404;
        }

        $info = array("api" => $_GET['action'], "error" => $error, "http_status_codes" => $http_status_codes, "success" => !$error);

        echo json_encode($info);
    } else if ($action == 'remove_rate' && isset($_GET['recipe_id']) && is_numeric($_GET['recipe_id'])) {

        $recipeId = Coder::code($_GET['recipe_id']);
        $rate = new Rate(0,$_SERVER['REMOTE_ADDR'],$recipeId);

        $rm = new RateMapper();

        if ($rm->removeRate($rate) ){
            $error = False;
                $http_status_codes = 201;
           
        } else {
            $error = TRUE;
            $http_status_codes = 404;
        }

        $info = array("api" => $_GET['action'], "error" => $error, "http_status_codes" => $http_status_codes, "success" => !$error);

        echo json_encode($info);
    }
    else {

    $info = array("api" => $_GET['action'], "error" => TRUE, "success" => FALSE, "http_status_codes" => 204);

    echo json_encode($info);
}
} else {

    $info = array("api" => null, "error" => TRUE, "success" => FALSE, "http_status_codes" => 204);

    echo json_encode($info);
}
?>