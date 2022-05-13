<?php

class Comment
{

    public $email;
    public $id;
    public $comment;
    public $errors = [];


    protected function validate()
    {
        if ($this->email == '') {

            $this->errors[] = 'Email is required';
        }
        if ($this->comment == '') {

            $this->errors[] = 'Comment is required';
        }

        return empty($this->errors);
    }


    public function addComment($conn)
    {
        if ($this->validate()) {

            $sql = 'INSERT INTO comments(email,comment)
                VALUES (:email, :comment)';

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);

            if ($stmt->execute()) {

                return true;
            } else {

                return false;
            }
        }
    }


    public static function getAllComments($conn) {

        $sql= 'SELECT * FROM comments';

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);

    }
}
