<?php
    session_start();
    if(isset($_SESSION['email']))
    {
        session_destroy();
        setcookie('email', $_SESSION['email'], time() + (0), "/");
        setcookie('firstname', $_SESSION['firstname'], time() + (0), "/");
    }
    header("Location:../index.php")
?>