<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductPrinter
 *
 * @author farid
 */
class RecipePrinter {

    public function getArray($recipe) {
        return array("id" => $recipe->getId(), 
            "description" => $recipe->getDescription(), 
            "title" => $recipe->getTitle(), 
            "image" => $recipe->getImage(), 
            "negativeRateCount" => $recipe->getNegativeRateCount(), 
            "positiveRateCount" => $recipe->getPositiveRateCount(), 
            "userRate" => $recipe->getUserRate(), 
            "date" => $recipe->getDate());
    }
    
    public function getJson($recipe) { 
        return json_encode($this->getArray($recipe));
    }

 }

?>
