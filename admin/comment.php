<?php require './includes/init.php'; ?>


<?php
$db = new Database();
$conn = $db->getConn();
if(Auth::isAdminLoggedIn()){

    $comments = Comment::getAllComments($conn);
} else {
    die('Login in to see comments');
}


?>
<?php require 'includes/header.php';?>

 <?php if(empty($comments)):?>
    <h2 class="text-center " id="hello">No comments.</h2>
      <?php else : ?>
        <h2 class="text-center mb-4">Comments</h2>
        <div id="hello">
        <table class="table table-dark" >
          <thead>
            <tr>
            
              <th>From</th>
              <th>comment</th>
       
        </tr>
      </thead>
      <tbody>
        <?php foreach($comments as $key => $comment): ?>
          <tr>
            
            <td><p><?= $comment['email'] ?></p></td>
            <td><p><?= $comment['comment'] ?></p></td>
     
         
          </tr>
          
          
          <?php endforeach; ?>
        </tbody>
        
      </table>
        </div>
      
      <?php endif; ?>
      <div id="hello"></div>

<?php require 'includes/footer.php' ?>