<?php

require 'includes/init.php';
$db = new Database();
$conn =  $db->getConn();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    

    if(User::authenticate($conn,trim($_POST['username']), $_POST['password'])) {
        

        Auth::login($_POST['username']);
       Url::redirect("/");

}else {

        $error = 'Login incorrect';
    }




}
?>

<?php require './includes/header.php'; ?>

<div class="container" id="hello" >

<div>
<?php if(! empty($error)): ?>
<p><?=$error?></p>

<?php endif; ?>


    <form method="post">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" id="username" class="form-control">
        </div>
        
        <div class="form-group">
            
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button class="btn btn-primary">Log in</button>
    </form>
    
    <div>
        <ul class="nav">
         
            <li class="nav-item">
                
                <a class="nav-link" href="register.php">Register</a>
                
            </li>
            
        </ul>
    </div>
    
    
</div>

</div>
<?php require './includes/footer.php'; ?>