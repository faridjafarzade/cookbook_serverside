<?php
class Recipe implements DBObject{

    private $title;
    private $description;
    private $positiveRateCount = 0;
    private $negativeRateCount = 0;
    private $userRate = 0;
    private $image = NULL;
    private $id = 0;
    private $date = NULL;
            
    public function __construct($id = 0, $title = NULL, $description = NULL, $image = NULL, $positiveRateCount = 0, $negativeRateCount = 0) {
        
        $this->title = $title;
        $this->description = $description;
        $this->positiveRateCount = $positiveRateCount;
        $this->negativeRateCount = $negativeRateCount;
        $this->image = $image;
        $this->id = $id;
        
    }

    
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function getPositiveRateCount() {
        return $this->positiveRateCount;
    }

    public function getNegativeRateCount() {
        return $this->negativeRateCount;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPositiveRateCount($positiveRateCount) {
        $this->positiveRateCount = $positiveRateCount;
    }

    public function setNegativeRateCount($negativeRateCount) {
        $this->negativeRateCount = $negativeRateCount;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }
    
    function getUserRate() {
        return $this->userRate;
    }

    function setUserRate($userRate) {
        $this->userRate = $userRate;
    }


    

}
