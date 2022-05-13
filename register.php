  <?php

  require './includes/init.php';

  $db = new Database();
  $conn =  $db->getConn();

    $user = new User();
    $reg= '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    

      $user->username = trim($_POST['username']);
      $user->email = $_POST['email'] ;
      $user->password = $_POST['password'];
      $user->confirm_password = $_POST['confirm-password'];
      $user->location = $_POST['location'];
      $user->pay_password = $_POST['payment'];

    
    if($user->register($conn)){
        $reg = 'success';

      

      // Url::redirect("/project/log.php");

    }



  }
  ?>

  <?php require './includes/header.php'; ?>

<div class="container">
  <h2>Register</h2>

  <?php if (!empty($user->errors)) : ?>
      <ul>
          <?php foreach ($user->errors as $error) : ?>
              <li> <?= $error ?> </li>

          <?php endforeach; ?>
      </ul>
  <?php endif; ?>

  <form method="post">

  <div class="form-group">
  <label for="username">Username</label>
  <input class="form-control" name="username" id="username" value="<?= htmlspecialchars($user->username);?> ">
  </div>

  <div class="form-group">
  <label for="email">Email</label>
  <input class="form-control" name="email" id="email" type="email" value="<?= htmlspecialchars($user->email);?>" required>
  </div>

  <div class="form-group">
  <label for="password">Password</label>
  <input class="form-control" type="password" name="password" id="password" >
  </div>

  <div class="form-group">
  <label for="confirm-password">Confirm Password</label>
  <input class="form-control" name="confirm-password" id="confirm-password" type="password" >
  </div>

  <div class="form-group">
      <label for="location">Location</label>
  <input class="form-control" name="location" id="location" value="<?= htmlspecialchars($user->location);?>"> 
  </div>

  <div class="form-group">
  <label for="payment">Payment Password</label>
  <input class="form-control" name="payment" id="payment" type="password" value="<?= htmlspecialchars($user->pay_password);?>">
  </div>


  <button class="btn btn-primary">Register</button>

  <?php if($reg): ?>

  <h3>registration successful</h3>
  <a class="btn btn-primary" href="log.php">Login</a>

  <?php endif;?>
  </form>

  </div>

  <?php require './includes/footer.php'; ?>