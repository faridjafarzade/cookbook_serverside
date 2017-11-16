<?php

class Rate implements DBObject{

    private $id = 0;
    private $userIp;
    private $recipeId = 0;
    private $date = 0;
    private $positive = FALSE;
    
    function __construct($id = 0, $userIp = 0 , $recipeId = 0, $positive = FALSE ,$date = NULL) {
        $this->id = $id;
        $this->userIp = $userIp;
        $this->recipeId = $recipeId;
        $this->date = $date;
        $this->positive = $positive;
    }

    function getId() {
        return $this->id;
    }

    function getUserIp() {
        return $this->userIp;
    }

    function getRecipeId() {
        return $this->recipeId;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserIp($userIp) {
        $this->userIp = $userIp;
    }

    function setRecipeId($recipeId) {
        $this->recipeId = $recipeId;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function getPositive() {
        return $this->positive;
    }

    function setPositive($positive) {
        $this->positive = $positive;
    }


    
    



}
