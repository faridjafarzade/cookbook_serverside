<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RateMapper
 *
 * @author farid
 */
class RateMapper extends Mapper {

    public function abstractRemove(DBObject $rate) {

        $sql_d = $this->dbh->getConnection()->prepare('Delete from rate where recipe_id = ? and user_ip = ?');

        $recipeId = $rate->getRecipeId();
        $userIp = $rate->getUserIp();

        $sql_d->bindParam(1, $recipeId, PDO::PARAM_INT);
        $sql_d->bindParam(2, $userIp, PDO::PARAM_STR);
        

        if ($sql_d->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function abstractInsert(DBObject $rate = null) {

        $sql_i = $this->dbh->getConnection()->prepare("INSERT INTO `rate` (recipe_id , user_ip , positive) VALUES ( ? , ? ,?)");

        $recipeId = $rate->getRecipeId();
        $userIp = $rate->getUserIp();
        $positive = $rate->getPositive();

        $sql_i->bindParam(1, $recipeId, PDO::PARAM_INT);
        $sql_i->bindParam(2, $userIp, PDO::PARAM_STR);
        $sql_i->bindParam(3, $positive, PDO::PARAM_INT);
        
        if ($sql_i->execute()) {

            $id = $this->dbh->getConnection()->lastInsertId();
            $rate->setId($id);
            
            return $rate;
        } else {
            return FALSE;
        }
    }

    public function abstractSelect(DBObject $rate) {
        
        $query = 'SELECT COUNT(ID) as count  FROM rate where recipe_id  = ? and user_ip = ?';

        $sql_p = $this->dbh->getConnection()->prepare($query);

        $recipeId = $rate->getRecipeId();
        $userIp = $rate->getUserIp();
        
        $sql_i->bindParam(1, $recipeId, PDO::PARAM_INT);
        $sql_i->bindParam(2, $userIp, PDO::PARAM_STR);

        $sql_p->execute();

        $result = $sql_p->fetchColumn();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isRate(DBObject $rate) {

        $query = 'SELECT COUNT(ID) as count  FROM rate where id  = ? ';

        $sql_p = $this->dbh->getConnection()->prepare($query);

        $id = $rate->getId();

        $sql_p->bindParam(1, $id, PDO::PARAM_INT);

        $sql_p->execute();

        $result = $sql_p->fetchColumn();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
   

    public function abstractUpdate(DBObject $rate) {

        $sql_u = $this->dbh->getConnection()->prepare("UPDATE rate set positive =  ? ,date = ? Where recipe_id = ? and user_ip = ?; ");
        
        $recipeId = $rate->getRecipeId();
        $userIp = $rate->getUserIp();
        $positive = $rate->getPositive();
        $date = $rate->getDate();

        $sql_u->bindParam(1, $positive, PDO::PARAM_INT);
        $sql_u->bindParam(2, $date, PDO::PARAM_STR);
        $sql_u->bindParam(3, $recipeId, PDO::PARAM_INT);
        $sql_u->bindParam(4, $userIp, PDO::PARAM_STR);
        
        if ($sql_u->execute()) {
            return $rate;
        } else {
            return FALSE;
        }
        
        return FALSE;
    }

    public function abstractSave(DBObject $recipe) {
        
        if($recipe->getId()==0)
            return $this->insert($recipe);
        else 
            return $this->update($recipe);
    }
    
    
    
     //This function have to be in different class like UserAction Manager but I have not User class 
    public function getUserRate(DBObject $recipe,$userIp) {

        $id = $recipe->getId();
        
        $query = 'SELECT positive  , COUNT(ID) as count  FROM rate where recipe_id  = ? and user_ip = ?';

        $sql_p = $this->dbh->getConnection()->prepare($query);

        $sql_p->bindParam(1, $id, PDO::PARAM_INT);
        $sql_p->bindParam(2, $userIp, PDO::PARAM_STR);

        $sql_p->execute();

        $result = $sql_p->fetchAll();
        
        if($result[0]['count']>0)
            if($result[0]['positive']==1)
                return 2;
            else 
                return 1;
        else
            return 0;
    }

}

?>
