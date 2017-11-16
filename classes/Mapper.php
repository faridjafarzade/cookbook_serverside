<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mapper
 *
 * @author farid
 */
abstract class  Mapper {
    
    public $dbh = null;

    function __construct($dbh = FALSE) {
        if(!$dbh) $this->dbh = $this->dbh = DBConnection::getInstance();
        else  $this->dbh = $dbh;
    }

    abstract public function abstractRemove(DBObject $object);

    abstract public function abstractSave(DBObject $object);

    abstract public function abstractUpdate(DBObject $object);  
    
    abstract public function abstractInsert(DBObject $object);
    
    abstract public function abstractSelect(DBObject $object);



    // this function let modify all remove functions when I need 
    public function remove(DBObject $object){
        
        return $this->abstractRemove($object);
    }
    
    // this function let modify all save functions when I need 
    public function save(DBObject $object){
        
       return  $this->abstractSave($object);
    }
    
    // this function let modify all update functions when I need 
    public function update(DBObject $object){
        
        return $this->abstractUpdate($object);
    }
    
    // this function let modify all insert functions when I need 
    public function insert(DBObject $object){
        
       return  $this->abstractInsert($object);
    }
    
    // this function let modify all select functions when I need 
    public function select(DBObject $object){
        
        return $this->abstractSelect($object);
    }
    
    
    
}

?>
