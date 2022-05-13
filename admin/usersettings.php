        <?php

        require './includes/init.php';


        $db = new Database();
        $conn = $db->getConn();

        if (Auth::isAdminLoggedIn()) {
            $name = $_SESSION['adminname'];
            $user = new Admin();

            $reg = '';

            if ($user->getByUsername($conn, $name)) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                    $user->email = $_POST['email'];
                    $user->password = $_POST['password'];
                    $user->confirm_password = $_POST['confirm-password'];
                    $user->location = $_POST['location'];
                    $user->pay_password = $_POST['payment'];


                    if ($user->updateRegister($conn, $name)) {

                        $reg = 'success';
                    }
                }
            } else {
                die("ERROR");
            }
        } else {

            die("LogIn to access settings");
        }

        ?>

        <?php require './includes/header.php'; ?>

        <div class="container">

            <form method="post">

                <h2>Update Profile</h2>

                <?php if (!empty($user->errors)) : ?>
                    <ul>
                        <?php foreach ($user->errors as $error) : ?>
                            <li> <?= $error ?> </li>

                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>


                <div class="form-group">

                    <label for="email">New email</label>
                    <input class="form-control" name="email" id="email" type="email" required>
                </div>

                <div class="form-group">
                    <label for="password">New password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input class="form-control" name="confirm-password" id="confirm-password" type="password">
                </div>

                <div class="form-group">
                    <label for="location">New location</label>
                    <input class="form-control" name="location" id="location" value="<?= htmlspecialchars(''); ?>">
                </div>

                <div class="form-group">
                    <label for="payment">New payment password</label>
                    <input class="form-control" name="payment" id="payment" type="password" value="<?= htmlspecialchars(''); ?>">
                </div>

                <button class="btn btn-primary">Update</button>

            </form>

            <?php if ($reg) : ?>

                <h3>Update successful</h3>
                <a href="log.php">Login</a>

            <?php endif; ?>


        </div>



        <?php require './includes/footer.php' ?>