<?php
class CheckedRecipe extends Recipe {

    public function __construct($id = 0, $title = NULL, $description = NULL, $image = NULL, $positiveRateCount = 0, $negativeRateCount = 0, $date = 0) {
         
        $this->title = Coder::code($title);
        $this->description = Coder::code($description);
        $this->positiveRateCount = Coder::code($positiveRateCount);
        $this->negativeRateCount = Coder::code($negativeRateCount);
        $this->image = Coder::code($image);
        $this->id = Coder::code($id);
        $this->date = $date;
        
    }

    
    public function getTitle() {
        return Coder::decode($this->title);
    }

    public function setTitle($title) {
        $this->title = Coder::code($title);
    }

    public function getId() {
        return Coder::decode($this->id);
    }

    public function setId($id) {
        $this->id = Coder::code($id);
    }
    
    public function getDescription() {
        return Coder::decode($this->description);
    }

    public function getPositiveRateCount() {
        return Coder::decode($this->positiveRateCount);
    }

    public function getNegativeRateCount() {
        return Coder::decode($this->negativeRateCount);
    }

    public function setDescription($description) {
        $this->description = Coder::code($description);
    }

    public function setPositiveRateCount($positiveRateCount) {
        $this->positiveRateCount = Coder::code($positiveRateCount);
    }

    public function setNegativeRateCount($negativeRateCount) {
        $this->negativeRateCount = Coder::code($negativeRateCount);
    }

    public function getImage() {
        return Coder::decode($this->image);
    }

    public function setImage($image) {
        $this->image = Coder::code($image);
    }

    

}
