<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductMapper
 *
 * @author farid
 */
class RecipeMapper extends Mapper{
    
    

    public function abstractRemove(DBObject $recipe) {

        $sql_d = $this->dbh->getConnection()->prepare('Delete from recipe where id = ?');
        
        $id = $recipe->getId();
        
        $sql_d->bindParam(1, $id, PDO::PARAM_INT);
        
        if ($sql_d->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
        
    public function abstractUpdate(DBObject $recipe){
        
        $sql_u = $this->dbh->getConnection()->prepare("UPDATE recipe set description =  ? , title = ? ,image = ?,date = ? Where id = ? ; ");
        
        $title = $recipe->getTitle();
        $description = $recipe->getDescription();
        $image = $recipe->getImage();
        $id = $recipe->getId();
        $date = $recipe->getDate();
        
        $sql_u->bindParam(1, $description, PDO::PARAM_STR);
        $sql_u->bindParam(2, $title, PDO::PARAM_STR);
        $sql_u->bindParam(3, $image, PDO::PARAM_STR);
        $sql_u->bindParam(4, $date, PDO::PARAM_STR);
        $sql_u->bindParam(5, $id, PDO::PARAM_INT);
        
        if ($sql_u->execute()) {
            return $recipe;
        } else {
            return FALSE;
        }
        
    }
    
    public function abstractInsert(DBObject $recipe) {
        
        $sql_i = $this->dbh->getConnection()->prepare("INSERT INTO recipe (title,description,image) VALUES (?,?,?);");

        $title = $recipe->getTitle();
        $description = $recipe->getDescription();
        $image = $recipe->getImage();
        
        $sql_i->bindParam(1, $title, PDO::PARAM_STR);
        $sql_i->bindParam(2, $description, PDO::PARAM_STR);
        $sql_i->bindParam(3, $image, PDO::PARAM_STR);
        
        if ($sql_i->execute()) {
            
            $recipe->setId($this->dbh->getConnection()->lastInsertId());
            return $this->select($recipe);
            
        } else {
            return FALSE;
        }
      }

    public function abstractSave(DBObject $recipe) {
        if ($recipe->getId()==0) {
            
            return $this->insert($recipe);
            
        } else
            
            return $this->update($recipe);
    }
    
    public function abstractSelect(DBObject $recipe) {
        
        $query = 'SELECT title , description , image , date FROM recipe where id  = ? ';

        $id = $recipe->getId();

        $sql_p = $this->dbh->getConnection()->prepare($query);

        $sql_p->bindParam(1, $id, PDO::PARAM_INT);

        $sql_p->execute();

        $result = $sql_p->fetchAll();
        
        $result = $result[0];
        
        if ($result) {
            $recipe = new CheckedRecipe($id, $result['title'], $result['description'], $result['image']);
            $recipe->setDate($result['date']);
            return $recipe;
        }
        else {
            return FALSE;
        }
        
        
      }
      
    public function updateDescription(DBObject $recipe) {
        
        $sql_u = $this->dbh->getConnection()->prepare("UPDATE recipe set description =  ?  Where id = ? ; ");

        $description = $recipe->getDescription();
        $id = $recipe->getId();
        
        $sql_u->bindParam(1, $description, PDO::PARAM_INT);
        $sql_u->bindParam(2, $id, PDO::PARAM_INT);
        
        if ($sql_u->execute()) {
            
           return $this->select($recipe);
           
        } else {
            
            return FALSE;
        }
    }
    
    public function updateTitle(DBObject $recipe) {
        $sql_u = $this->dbh->getConnection()->prepare("UPDATE recipe set title = ?  Where id = ? ; ");

        $title = $recipe->getTitle();
        $id = $recipe->getId();
        
        $sql_u->bindParam(1, $title, PDO::PARAM_STR);
        $sql_u->bindParam(2, $id, PDO::PARAM_INT);
        
        if ($sql_u->execute()) {
            
           return $this->abstractSelect($recipe);
           
        } else {
            
            return FALSE;
        }
    }

    public function isRecipe(Recipe $recipe) {

        $query = 'SELECT COUNT(ID) as count  FROM recipe where id  = ? ';

        $sql_p = $this->dbh->getConnection()->prepare($query);
        
        $id = $recipe->getId();

        $sql_p->bindParam(1, $id, PDO::PARAM_INT);

        $sql_p->execute();

        $result = $sql_p->fetchColumn();
        
        if ($result > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
     }
     
    public function getPositiveRateCount(DBObject $recipe) {

        $query = 'SELECT COUNT(ID) as count  FROM rate where recipe_id  = ? and positive = 1';

        $id = $recipe->getId();
        
        $sql_p = $this->dbh->getConnection()->prepare($query);

        $sql_p->bindParam(1, $id, PDO::PARAM_INT);

        $sql_p->execute();

        $result = $sql_p->fetchColumn();

        return $result;
    }
     
    public function getNegativeRateCount(DBObject $recipe) {

        $query = 'SELECT COUNT(ID) as count  FROM rate where recipe_id  = ? and positive = 0';

        $id = $recipe->getId();
        
        $sql_p = $this->dbh->getConnection()->prepare($query);

        $sql_p->bindParam(1, $id, PDO::PARAM_INT);

        $sql_p->execute();

        $result = $sql_p->fetchColumn();

        return $result;
    }

 }

?>
