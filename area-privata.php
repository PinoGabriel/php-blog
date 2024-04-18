<?php
require_once "config.php";

session_start();
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {
    header('Location: login.html');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];

    // Query per eliminare il post dal database
    $delete_query = "DELETE FROM posts WHERE id = $post_id";
    if ($mysqli->query($delete_query) === TRUE) {
        // Eliminazione avvenuta con successo
        header("Refresh:0"); // Ricarica la pagina per mostrare i post aggiornati
        exit;
    } else {
        echo "Errore durante l'eliminazione del post: " . $mysqli->error;
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
        <h1 class="text-center text-light">Area Privata</h1>
        <div>
            <a href="logout.php" class="btn btn-primary">Disconnetti</a>
            <a href="crea-post.php" class="btn btn-success">Crea Post</a>
            <a href="crea-categoria.php" class="btn btn-warning">Crea Categoria</a>
        </div>
    </header>

    <main>
        <div class="container mt-5">

            <!-- Visualizza i post dell'utente -->
            <h2 class="mt-5">I Miei Post</h2>
            <?php
            $user_id = $_SESSION["id"];
            $sql = "SELECT * FROM posts WHERE user_id = $user_id";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-header'>" . $row["title"] . "</div>";
                    echo "<div class='card-body'>" . $row["content"] . "</div>";
                    // Aggiungi il pulsante Delete per ogni post
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='post_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' class='btn btn-danger d-block ms-auto' name='delete_post'>Delete</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Non hai ancora creato nessun post.</p>";
            }
            ?>
        </div>
    </main>

</body>

</html>