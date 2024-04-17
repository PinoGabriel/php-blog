<?php
require_once "config.php";

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
            <a href="login.html" class="btn btn-primary">Login</a>
        </div>
    </header>

    <div class="container">

        <h1 class="text-center mt-5">Posts</h1>

        <?php $query = "SELECT * FROM posts"; ?>
        <?php $result = $mysqli->query($query); ?>
        <?php while ($array = $result->fetch_array()) { ?>

            <div class="row m-5">
                <div class="card col-12">
                    <img src="<?php echo $array['image']; ?>" class="card-img-top" alt="<?php echo $array['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $array['title']; ?></h5>
                        <p class="card-text"> <?php echo $array['content']; ?></p>
                        <a href="page.php?id=<?php echo $array['id']; ?>" class="btn btn-primary">Mostra il Post</a>
                    </div>
                </div>
            </div>

        <?php } ?>

        <?php $mysqli->close(); ?>

    </div>



</body>

</html>