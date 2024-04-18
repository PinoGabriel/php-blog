<?php

require_once "config.php";

session_start();
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {
    header('Location: login.html');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $mysqli->real_escape_string($_POST["titolo"]);
    $contenuto = $mysqli->real_escape_string($_POST["contenuto"]);
    $user_id = $_SESSION["id"];

    // Inserimento del nuovo post nel database
    $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$titolo', '$contenuto', $user_id)";
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['post_success'] = true; // Imposta una variabile di sessione per indicare il successo del post
        header('Location: ' . $_SERVER['PHP_SELF']); // Redirect per evitare il reinvio del modulo
        exit();
    } else {
        echo "Errore durante la creazione del post: " . $mysqli->error;
    }
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
        <div class="container mt-5">
            <h2>Nuovo Post</h2>
            <!-- Form per creare un nuovo post -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="titolo" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="titolo" name="titolo" required>
                </div>
                <div class="mb-3">
                    <label for="contenuto" class="form-label">Contenuto</label>
                    <textarea class="form-control" id="contenuto" name="contenuto" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success mb-5">Invia</button>
            </form>

            <?php if (isset($_SESSION['post_success'])) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    Post creato con successo!
                </div>
            <?php unset($_SESSION['post_success']);
            endif; ?>

            <a href="area-privata.php"><input type="button" class="btn btn-primary mt-5 d-block mx-auto" value="Torna all'area privata"></a>
        </div>
    </main>

</body>

</html>