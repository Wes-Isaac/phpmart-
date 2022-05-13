<?php require './includes/init.php'; ?>
<?php require './includes/header.php';
if (Auth::isLoggedIn()) {
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $values = [];
    $POST = $_POST;
    $total = array_shift($POST);
    

    
    $keys = array_keys($_POST);
    for ($i = 0; $i < count($keys); $i++) {
      $key = $keys[$i];

      
      $values[] = $_POST[$key];
    }

    $_SESSION['total'] = $total;
    $_SESSION['keys'] = $keys;
    $_SESSION['values'] = $values;


    // print_r($keys);
    // print_r($values);
  }
} else {

  die('require login');
}

?>


<div class="container">
  <h2 class="my-4 text-center">Charge - <?= $_SESSION['total'] . " RMB" ?> </h2>
  <form action="./charging.php" method="post" id="payment-form">
    <div class="form-row">
      <input type="password" name="payment_password" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Password">

      <div id="card-element" class="form-control">
        <!-- a Stripe Element will be inserted here. -->
      </div>

      <!-- Used to display form errors -->
      <div id="card-errors" role="alert"></div>
    </div>

    <button>Submit Payment</button>
  </form>
</div>

<footer id="main-footer" class="mt-5">
  <div class=" foot-container bg-dark">


    <div id="contact-info" class="foot-item bg-dark">
      <h2 class="text-white">Contact Info</h2>
      <p class="text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas, non modi officia perferendis itaque explicabo similique dolorum cum culpa optio.</p>
    </div>

    <div id="site-link" class="foot-item bg-dark">
      <p class=" text-center"><a class="text-white" href="../project/orders.php">Orders</a></p>
      <p class="text-white text-center"><a class="text-white" href="../project/transaction.php">Payment</a></p>
      <p class="text-white text-center"><a class="text-white" href="../project/comment.php">Leave a comment</a></p>
    </div>

    <div id="subscribe" class="foot-item bg-dark">
      <form action="" method="post">
        <label for="sub-input">Subscribe</label>
        <textarea class="form-control" type="text" id="sub-input"> </textarea>
        <button class=" mt-4 btn btn-primary">Subscribe</button>
      </form>
    </div>





  </div>


</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="./js/charge.js"></script>
</body>

</html>