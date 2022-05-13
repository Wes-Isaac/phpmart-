<?php

class Order {

    public $id;
    public $username;
    public $item;
    public $quantity;
    public $total;
    public $created_at;

    public function addOrder($conn) {

        $sql = 'INSERT INTO orders (username, items, quantity)
                VALUES (:username, :items,:quantity)';

        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':items', $this->item, PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);

        if($stmt->execute()){

            return true;
        }else{

            return false;
        } 
        

    }

    public static function getAllOrders($conn) {

        $sql= 'SELECT * FROM orders';

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function getOrder($conn, $name) {

         $sql= "SELECT *
         FROM orders
         WHERE username= '$name'";

        $result = $conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
                
    }



}
