<?php require './includes/init.php'; ?>


<?php
$db = new Database();
$conn = $db->getConn();
$comment = new Comment();
$reg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $comment->email = $_POST['email'];
    $comment->comment = $_POST['comment'];
   

    if ($comment->addComment($conn)) {

        $reg = 'success';
    } else {
        die('Error');
    }
}
?>
<?php require 'includes/header.php' ?>

<?php if (!empty($comment->errors)) : ?>
    <ul>
        <?php foreach ($comment->errors as $error) : ?>
            <li> <?= $error ?> </li>

        <?php endforeach; ?>
    </ul>

<?php endif; ?>
<?php if ($reg) : ?>

    <h2>Thanks for your comment.</h2>
<?php endif; ?>
<div class="container ">

    <form method="post">
        <div class="form-group">

            <label for="email">Email</label>
            <input type="" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="textarea">Leave a comment</label>
            <textarea class="form-control" name="comment" id="textarea" cols="30" rows="10"><?= htmlspecialchars($comment->comment); ?></textarea>

        </div>
        <button class="btn btn-primary">Submit</button>
    </form>

</div>

<?php require 'includes/footer.php' ?>