<?php

class Database 
{

    public function getConn()
    {
       

        
        $db_host = "localhost";
        $db_user = "cms";
        $db_name = "mart";
        $db_password = "F7BH_ZDYSbxUQnQj";
        // $db_host = "sql105.epizy.com";
        // $db_user = "epiz_30464183";
        // $db_name = "epiz_30464183_martonline";
        // $db_password = "4MovTbexF5P";
        
        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
       try{

        $db = new PDO($dsn, $db_user, $db_password);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;


        }

        catch(PDOException $e) {
            
            echo $e->getMessage();
            exit;


        }


       
    }


}