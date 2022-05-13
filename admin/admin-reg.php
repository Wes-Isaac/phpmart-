<?php

require './includes/init.php';

$db = new Database();
$conn =  $db->getConn();

$admin = new Admin();
$reg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    

    $admin->adminname = trim($_POST['name']);
    $admin->email = $_POST['email'];
    $admin->password = $_POST['password'];
    $admin->confirm_password = $_POST['confirm-password'];
    $admin->location = $_POST['location'];


    if ($admin->register($conn)) {
        $reg = 'success';



        // Url::redirect("/project/log.php");

    }
}
?>

<?php require './includes/header.php'; ?>

<div class="container">

<h2>Register</h2>

<?php if (!empty($admin->errors)) : ?>
    <ul>
        <?php foreach ($admin->errors as $error) : ?>
            <li> <?= $error ?> </li>

        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="post">

    <div class="form-group">
        <label for="name">Adminname</label>
        <input class="form-control" name="name" id="name" value="<?= htmlspecialchars($admin->adminname); ?> ">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" name="email" id="email" type="email" value="<?= htmlspecialchars($admin->email); ?>" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input class="form-control" name="confirm-password" id="confirm-password" type="password">
    </div>

    <div class="form-group">
        <label for="location">Location</label>
        <input class="form-control" name="location" id="location" value="<?= htmlspecialchars($admin->location); ?>">
    </div>



    <button class="btn btn-primary" >Register</button>

    <?php if ($reg) : ?>

        <h3>registration successful</h3>
        <a href="admin.php">Admin Login</a>

    <?php endif; ?>
</form>

</div>

<?php require './includes/footer.php'; ?>