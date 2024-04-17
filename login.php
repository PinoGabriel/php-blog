<?php
require_once "config.php";

$username = $mysqli->real_escape_string($_POST['username']);
$password = $mysqli->real_escape_string($_POST['password']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql_select = "SELECT * FROM users WHERE username = '$username'";
    if ($result = $mysqli->query($sql_select)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (password_verify($password, $row['password'])) {
                session_start();

                $_SESSION['loggato'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header('Location: area-privata.php');
            } else {
                echo "la password non corrisponde";
            }
        } else {
            echo "Non ci sono account con quello username";
        }
    } else {
        echo "Errore in fase di login";
    }

    $mysqli->close();
}
