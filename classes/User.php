<?php
class User
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $pay_password;
    public $location;
    public $errors = [];



    public static function authenticate($conn,$uname,$passwrd) {

        $sql = "SELECT *
                FROM users
                WHERE username = :username";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username',$uname, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();
        
       

        if($user= $stmt->fetch()) {

          
           return password_verify($passwrd,$user->password);
        
           
        }

     
    }

   





    protected function validate()
    {
        if(!empty($this->username)){
            if ($this->username == '') {

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
        if ($this->pay_password == '') {

            $this->errors[] = 'payment password is required';
        }


        return empty($this->errors);
    }







    public function register($conn)
    {

        if ($this->validate()) {

            $sql = "INSERT INTO users (username, email,
            password, location, payment_password)
            VALUES(:username, :email, :password,  :location, :payment)";

            $stmt = $conn->prepare($sql);


            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $this->hasher($this->password), PDO::PARAM_STR);
            $stmt->bindValue(':location', $this->location, PDO::PARAM_STR);
            $stmt->bindValue(':payment', $this->hasher($this->pay_password), PDO::PARAM_STR);



           return $stmt->execute();
        }
        return false;
    }

    public function updateRegister($conn,$name) {
        
        if($this->validate()) {

            $sql = "UPDATE users
                    SET email = :email,
                        password = :password,
                        location = :location,
                        payment_password = :payment
                    WHERE username = '$name' ";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $this->hasher($this->password), PDO::PARAM_STR);
            $stmt->bindValue(':location', $this->location, PDO::PARAM_STR);
            $stmt->bindValue(':payment', $this->hasher($this->pay_password), PDO::PARAM_STR);

            return $stmt->execute();
             
        }

        return false;


    }

    protected function hasher($pass) {
       $hashed = password_hash($pass,PASSWORD_DEFAULT);
        return $hashed;

    }


    public function getByUsername($conn, $name) {

        $sql= "SELECT *
        FROM users 
        WHERE username= '$name'";

        $result =  $conn->query($sql);
        
        if($result->fetchAll(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;

    }

    public function passwordChecker($conn, $name=null, $password) {


        $sql= "SELECT payment_password
        FROM users 
        WHERE username='$name'";

        $result = $conn->query($sql);

        $result = $result->fetch(PDO::FETCH_ASSOC);
        
           
       return password_verify($password,$result['payment_password']);


    }


}
