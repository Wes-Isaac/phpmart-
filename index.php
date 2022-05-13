<?php require './includes/init.php';

$db = new Database();
$conn =  $db->getConn();

// $trasac = new Order();
// if ($_SESSION['username']) {


//     if ($result = $trasac->getOrder($conn, $_SESSION['username'])) {

//         var_dump($result);
//     }
// }

?>

<?php require './includes/header.php'; ?>

<div id="item"></div>
<div class="list container-grid"></div>
<div class="page">
    <ul class="pagination">
    </ul>
</div>
<form method="POST" class="form-display container-grid-form " action="purchase.php" id="form">
    <input class="btn btn-info" id="btb" type="submit" value="Purchase">



    <div class="item-grid">


        <div class="item-flex-form">

            <span>item</span>
            <span>price</span>
            <span>quantity</span>


            <div class="total">

                <label for="total">Total</label>
                <input name="total" id="total" readonly>
            </div>
        </div>

    </div>




    <div class="cart-items"></div>

</form>






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





<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
<script src="request.js"></script>
<script async src="index.js"></script>



</body>

</html>