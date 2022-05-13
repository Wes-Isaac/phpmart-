    <?php
    class Item
    {


        public $id;
        public $item_name;
        public $quantity;
        public $price;
        public $description;
        public $image_name;
        public $errors;

        protected function validate()
        {
            if ($this->item_name == '') {
                $this->errors[] = 'Item name is required';
            }
            if ($this->price == '') {
                $this->errors[] = 'Price is required';
            }
            if ($this->quantity == '') {
                $this->errors[] = 'quantity is required';
            }
            if ($this->description == '') {
                $this->errors[] = 'description is required';
            }
            return empty($this->errors);
        }

        public function addItem($conn)
        {
            if ($this->validate()) {

                $sql = "INSERT INTO items( item_name, description, price, quantity) VALUES (:item_name, :description, :price, :quantity)";

                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':item_name', $this->item_name, PDO::PARAM_STR);
                $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);

                $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
                $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
                

                if ($stmt->execute()) {

                    $this->id = $conn->lastInsertId();
                    return true;
                }

            } 
            else {
                return false;
            }

        }


        public function update($conn) {
            
            if($this->validate()) {

                $sql = "UPDATE items
                 SET item_name = :item_name,
                     description = :description,
                     price = :price,
                     quantity = :quantity
                 WHERE id =:id";

                 $stmt = $conn->prepare($sql);
                 
                 $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                 $stmt->bindValue(':item_name', $this->item_name,PDO::PARAM_STR);
                 $stmt->bindValue(':description', $this->description,PDO::PARAM_STR);
                 $stmt->bindValue(':price', $this->price,PDO::PARAM_STR);
                 $stmt->bindValue(':quantity', $this->quantity,PDO::PARAM_STR);

                 return $stmt->execute();
            } else {
                return false;
            }


        }

        public function delete($conn) {

            $sql = "DELETE FROM items
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            return $stmt->execute();
        }




        public static function getById($conn, $id, $columns = '*') {

            $sql = "SELECT  $columns
                    FROM items 
                    WHERE id = :id";
            
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Item');

        if ($stmt->execute()) {

            return $stmt->fetch();
        }

        }

        public static function updateItem($conn,$name,$quantity) {

            $quan = intval(static::getQuantity($conn,$name));
            
            $quan = $quan - intval($quantity);
            
            $sql = "UPDATE items
                 SET quantity = :quantity
                 WHERE item_name =:item_name";

                  $stmt = $conn->prepare($sql);
                 
                  $stmt->bindValue(':item_name', $name, PDO::PARAM_STR);
                  $stmt->bindValue(':quantity', $quan,PDO::PARAM_STR);
 
                  return $stmt->execute();

        }

        protected static function getQuantity($conn,$name) {

            $sql = "SELECT  quantity
                    FROM items 
                    WHERE item_name = '$name'";
           $result = $conn->query($sql);
            


          $result = $result->fetch(PDO::FETCH_ASSOC);
           
           return $result['quantity'];

        }

        public function setImageFile ($conn, $filename) {

            $sql = "UPDATE items
                    SET image_name =:image_name
                    WHERE id =:id";
                
                $stmt = $conn->prepare($sql);
    
                $stmt->bindValue(':id', $this->id,PDO::PARAM_INT);
              
    
                $stmt->bindValue(':image_name', $filename, $filename ==null?PDO::PARAM_NULL :  PDO::PARAM_STR);
                
    
               return $stmt->execute();
                
        }





    }
