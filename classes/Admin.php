<?php

class Admin {


    public $adminname;
    public $email;
    public $password;
    public $confirm_password;
    public $location;
    public $keyword;
    public $errors = [];
    public $id;


    public static function authenticate($conn,$uname,$passwrd) {

        $sql = "SELECT *
                FROM owner
                WHERE admin_name = :username";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username',$uname, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Admin');

        $stmt->execute();
        
       

        if($user= $stmt->fetch()) {
          
           return password_verify($passwrd,$user->password);
              
           
        }

     
    }

    

    protected function validate()
    {

        if(!empty($this->adminname)){
            if ($this->adminname == '') {

                $this->errors[] = 'Username is required';
            }
         }
        if ($this->email == '') {

            $this->errors[] = 'Email is required';
        }
        if ($this->password == '') {

            $this->errors[] = 'password is required';
        }
        if ($this->confirm_password == '') {

            $this->errors[] = 'Confirm password is required';
        }
        if ($this->location == '') {

            $this->errors[] = 'Location is required';
        }
        
        if ($this->password !== $this->confirm_password) {

            $this->errors[] = 'password fields are different';
        }

    


        return empty($this->errors);
    }







    public function register($conn)
    {

        if ($this->validate()) {

            $sql = "INSERT INTO owner (admin_name, email,
            password, location)
            VALUES(:name, :email, :password,  :location)";

            $stmt = $conn->prepare($sql);


            $stmt->bindValue(':name', $this->adminname, PDO::PARAM_STR);

            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);

            $stmt->bindValue(':password',$this->hasher($this->password), PDO::PARAM_STR);

            $stmt->bindValue(':location', $this->location, PDO::PARAM_STR);



            if ($stmt->execute()) {

                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            return false;
        }
    }

    protected function hasher($pass) {
       $hashed = password_hash($pass,PASSWORD_DEFAULT);
        return $hashed;

    }


    public function getByUsername($conn, $name) {

        $sql= "SELECT *
        FROM owner 
        WHERE admin_name= '$name'";

        $result =  $conn->query($sql);
        
        if($result->fetchAll(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;

    }

    public function updateRegister($conn,$name) {
        
        if($this->validate()) {

            $sql = "UPDATE owner
                    SET email = :email,
                        password = :password,
                        location = :location,
                        password = :payment
                    WHERE admin_name = '$name' ";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $this->hasher($this->password), PDO::PARAM_STR);
            $stmt->bindValue(':location', $this->location, PDO::PARAM_STR);
            $stmt->bindValue(':payment', $this->hasher($this->pay_password), PDO::PARAM_STR);

            return $stmt->execute();
             
        }

        return false;


    }

}


