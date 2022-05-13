<?php

require 'includes/init.php';
$db = new Database();
$conn =  $db->getConn();
$user = new User();
$transaction = new Transaction();
$orders = new Order();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

   if($user->passwordChecker($conn,$_SESSION['username'],$POST['payment_password'])) {


        require_once('vendor/autoload.php');

        $stripe = new \Stripe\StripeClient('sk_test_51IW4TUKJIFZHCNhtyWyOAPnZkaBwCRhrPVUJIZL2Xm7K43RmgytvU21jOvgMWtRBLoWprRimwYB9263vWVEcFMBW00oUWuGNTF');


        $password = $POST['payment_password'];

        $token = $POST['stripeToken'];      

    

        $total = $_SESSION['total'] *100;

       



        //Create Customer In Stripe
        $customer = $stripe->customers->create([
        'name' => $_SESSION['username'],
        
        'source' => $token
        ]);

        //Charge Customer
        $charge = $stripe->charges->create([
        'amount' => $total,
        'currency' => 'usd',

        'description' => 'Mart Items',
        'customer' => $customer->id
        ]);

        if($customer && $charge) {

            $transaction->id = $charge->id;
            $transaction->username = $_SESSION['username'];
            $transaction->total = $total/100;
            $transaction->customer_id = $charge->customer;

           if($transaction->addTransaction($conn)) {
               
                foreach($_SESSION['keys'] as $i => $key){


                }

                for($i=1; $i < count($_SESSION['keys']); $i++ ) {

                    $orders->username = $_SESSION['username'];
                    $orders->item = $_SESSION['keys'][$i];
                    $orders->quantity =$_SESSION['values'][$i];

                    if(Item::updateItem($conn, $orders->item, $orders->quantity)) {
                        
                        $orders->addOrder($conn);
                    }
                  
                }


           }


        }




   }else{
       $user->errors[] = "password is not correct";
      
   }


}

?>
<?php require 'includes/header.php' ?>

<?php if(!empty($user->errors)): ?>

<h2> <?= $user->errors[0] ?> </h2>
 <a href="./index.php">home</a>
<?php else: ?>
<h1>PAYMENT SUCCESSFUL</h1>
<a href="./orders.php">ORDERS</a>

<?php endif; ?>
<div id="hello"></div>
<?php require 'includes/footer.php' ?>