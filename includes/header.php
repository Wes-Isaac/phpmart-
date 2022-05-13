<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main.css">
     
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" /> -->


</head>


<body>
    <nav class="navbar sticky-top">
        

            <ul class="nav navigate bg-dark">
                <li id="li" class="nav-item  p-2 flex-grow-1 bd-highlight "> <a class="nav-link text-light" href="../">Site Name</a></li>
                <li class="nav-item  p-2 bd-highlight"> <a class="nav-link text-light" href="../usersettings.php">User Settings</a></li>
                <?php if (Auth::isLoggedIn() || Auth::isAdminLoggedIn()) : ?>

                    <li class="nav-item p-2 bd-highlight"><a class="nav-link text-light" href="../logout.php">Log out</a></li>

                <?php else : ?>

                    <li class="nav-item p-2 bd-highlight"> <a class="nav-link text-light" href="../log.php">Login/Register</a></li>
                <?php endif; ?>
            </ul>
        
    </nav>