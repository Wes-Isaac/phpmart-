<?php require './includes/init.php'; ?>
<?php
if (Auth::isAdminLoggedIn()) {

    $db = new Database();
    $conn = $db->getConn();

    $payments = Transaction::getAllTransactions($conn);




}



?>
<?php require './includes/header.php'; ?>

<div class="mt-4 table-size">

    <?php if (empty($payments)) : ?>
        <h2 id="hello">No Payment.</h2>
            <?php else : ?>
                <h2 class="text-center mb-4">Payments</h2>
                <table class="table table-dark table-size">
                    <thead>
                        <tr>
                            
                            <th>username</th> -->
                            <th>Transaction id</th>
                            <th>amount(yuan)</th>
                            <th>date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $key => $payment) : ?>
                            <tr>
                                <td>
                                    <p><?= $payment['username'] ?></p>
                                </td>
                                <td>
                                    <p><?= $payment['id'] ?></p>
                                </td>
                                <td>
                                    <p><?= $payment['total'] ?></p>
                                </td>
                                <td>
                                    <p><?= $payment['created_at'] ?></p>
                                </td>


                            </tr>


                        <?php endforeach; ?>
                    </tbody>

                </table>


            <?php endif; ?>


</div>


<?php require './includes/footer.php' ?>
