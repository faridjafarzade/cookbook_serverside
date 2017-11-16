<?php
abstract class Pagination extends Page
{

    function __construct($tableName,$currentPage = 1, $dbh = FALSE) {
        
        $this->currentPage = $currentPage;
        $this->tableName = $tableName;
        
        if(!$dbh) 
            $this->dbh = DBConnection::getInstance();
        else  
            $this->dbh = $dbh;
    }

        
   public function getPage(){
       
       $page = new Page();
       
       $page->pageCount = $this->getPageCount();
       $page->nextPage = $this->getNextPage();
       $page->prevPage = $this->getPrevPage();
       $page->currentPage = $this->getCurrentPage();
       $page->items = $this->getItems();
       
       return $page;
    }
    
    public function getLimit() {
        return $this->limit;
    }

    public function getTableName() {
        return $this->tableName;
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;
    }

    public function getDbh() {
        return $this->dbh;
    }

    public function setDbh($dbh) {
        $this->dbh = $dbh;
    }

    public function getItems() {
        
        $query = $this->getQuery();
        
        $sql_p = $this->dbh->getConnection()->prepare($query);
        
        $sql_p->execute();
        
        $result = $sql_p->fetchAll(PDO::FETCH_ASSOC);
        
        $this->setItems($result);
        
        return $this->items;
    }
    
    // these class have to be different for all child class so they return different type objects like product 
    abstract public function setItems($result);
    
    abstract public function getQuery();
    
    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }

    public function getNextPage() {
        
        if($this->currentPage >= $this->pageCount) 
            $this->nextPage = FALSE;
        else 
            $this->nextPage = $this->currentPage+1;
        
        return $this->nextPage;
    }

    public function getPrevPage() {
        
         if($this->currentPage <= 1) 
             $this->prevPage = FALSE;
        else 
            $this->prevPage = $this->currentPage-1;
        
       return $this->prevPage;
    }

    public function getPageCount() {
            
             $sql_p = $this->dbh->getConnection()->prepare('SELECT COUNT(*) FROM '.$this->tableName);
             
             $sql_p->execute();
             
             $result = $sql_p->fetchColumn();
             
             if($result) {
                 
                 $remanat = $result%$this->limit;
                 
                 if($remanat>0){ 
                     
                     $result = $result - $remanat;
                     
                 $this->pageCount = $result/$this->limit+1;
                 
                 }
          else {
              
              $this->pageCount = $result/$this->limit;
              
          }
                  
                
             }
             else $this->pageCount = 0;
             
        
         
        return $this->pageCount;
    }



   
   }
