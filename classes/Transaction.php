<?php

class Transaction {

    public $id;
    public $username;
    public $customer_id;
    public $total;
    public $created_at;



    public function addTransaction($conn) {

        $sql = 'INSERT INTO transaction(id, username, customer_id, total)
                VALUES (:id, :username, :customerid, :total)';

        
        $stmt = $conn->prepare($sql);  
        
        $stmt->bindValue(':id', $this->id, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':customerid', $this->customer_id, PDO::PARAM_STR);
        $stmt->bindValue(':total', $this->total, PDO::PARAM_STR);

        if($stmt->execute()){

            return true;
        }else{

            return false;
        }

    }

    public static function getAllTransactions($conn) {

        $sql= 'SELECT * FROM transaction';

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function getTransaction($conn, $name) {

         $sql= "SELECT *
         FROM transaction
         WHERE username= '$name'";

        $result = $conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
                
    }


}