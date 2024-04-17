<?php

session_start();
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {
    header('Location: login.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpBlog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="container-fluid d-flex my-header justify-content-between align-items-center">
        <h1 class="text-center">My Awesome Blog</h1>
        <div>
            <a href="logout.php" class="btn btn-primary">Disconnetti</a>
        </div>
    </header>

    <main>
        <div class="container">
            <h1 class="mt-5">Area Privata</h1>

            <?php

            echo 'Benvenuto ' . $_SESSION['username'];

            ?>
        </div>
    </main>




</body>

</html>