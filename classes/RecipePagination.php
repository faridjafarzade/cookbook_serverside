<?php

class RecipePagination extends Pagination {

    public $printer;

    function __construct($currentPage = 1, $dbh = false) {
        parent::__construct('recipe', $currentPage, $dbh);
        $this->printer = new RecipePrinter();
    }

    function setItems($result) {
        foreach ($result as $row) {

            $recipe = new CheckedRecipe($row['id'], $row['title'], $row['description'], $row['image']);
            $recipe->setDate($row['date']);
            $rm = new RecipeMapper();
            $positiveRateCount = $rm->getPositiveRateCount($recipe);
            $negativeRateCount = $rm->getNegativeRateCount($recipe);
            
            $ram = new RateMapper();
            $userRate = $ram->getUserRate($recipe,$_SERVER['REMOTE_ADDR']);
            $recipe->setPositiveRateCount($positiveRateCount);
            $recipe->setNegativeRateCount($negativeRateCount); 
            $recipe->setUserRate($userRate);
                    
                    
            $this->items[] = $this->printer->getArray($recipe);
        }
    }

    function getQuery() {

        $currentRecipe = $this->limit * $this->prevPage;

        $query = 'Select id,title,description,image,date from ' . $this->tableName . ' limit ' . $currentRecipe . ',' . $this->limit;

        return $query;
    }

}
