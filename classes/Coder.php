<?php

class Coder
{
    public static function code($data) { 
        
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        
        return $data;
    }
    
     public static function decode($data) { 
         
        $data = htmlspecialchars_decode($data);
        $data = html_entity_decode($data);
        
        return $data;
    }
    
     public static function getNumber($data) { 
         
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        
        return $data;
    }
 }