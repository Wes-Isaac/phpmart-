<?php require './includes/init.php';?>
<?php
if(Auth::isAdminLoggedIn()){
// echo $_SESSION['username'];
// var_dump($_SESSION['values']);
$db = new Database();
$conn = $db->getConn();

// $payments = Transaction::getTransaction($conn,$_SESSION['username']);

$orders =  Order::getAllOrders($conn);





}



?>
<?php require './includes/header.php';?>

<div class="container mt-4">

  
  <?php if(empty($orders)):?>
    <h2 class="text-center " id="hello">No Orders.</h2>
      <?php else : ?>
        <h2 class="text-center mb-4">Orders</h2>
        <table class="table table-dark">
          <thead>
            <tr>
              <th>transaction id</th>
              <th>username</th>
              <th>Item</th>
              <th>amount</th>
         <th>date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($orders as $key => $order): ?>
          <tr>
            
            <td><p><?= $order['id'] ?></p></td>
            <td><p><?= $order['username'] ?></p></td>
            <td><p><?= $order['items'] ?></p></td>
            <td><p><?= $order['quantity'] ?></p></td>
            <td><p><?= $order['date'] ?></p></td>
            
            
          </tr>
          
          
          <?php endforeach; ?>
        </tbody>
        
      </table>
      
      
      <?php endif; ?>
      
    </div>

    <?php require 'includes/footer.php' ?>







         