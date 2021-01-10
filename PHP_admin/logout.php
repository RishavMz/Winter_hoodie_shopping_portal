<?php
    session_start();
    if(isset($_SESSION['admin4682']))
    {
        session_destroy();
    }
    header("Location:adminlogin.php")
?>