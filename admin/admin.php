<?php

require './includes/init.php';
$db = new Database();
$conn =  $db->getConn();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    if(Admin::authenticate($conn,trim($_POST['name']), $_POST['password'])) {
        
        
        Auth::adminLogin($_POST['name']);
    Url::redirect("/project/admin/");

}else {

        $error = 'Login incorrect';
    }




}
?>

<?php require './includes/header.php'; ?>

<div class="container">

<h2>Administrator</h2>
<h2>Login</h2>
<?php if(! empty($error)): ?>
<p><?=$error?></p>

<?php endif; ?>



<form method="post">

<div class="form-group">
<label for="name">name</label>
<input name="name" id="name" class="form-control">
</div>


<div  class="form-group">
<label for="password" >Password</label>
<input type="password" name="password" id="password" class="form-control">
</div>
<button class="btn btn-primary">Log in</button>
</form>


<div>

<a class="nav-link" href="admin-reg.php">Register as admin</a>


</div>

</div>

<?php require 'includes/footer.php'; ?>