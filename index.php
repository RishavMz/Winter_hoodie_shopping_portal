<!--
    Author : RishavMz
    This is the Login page.
    This is where anyone accessing the web application must come first, 
    else an access denied page would be redirected.
    This page starts the session for the student entry , and also has link to admin view page.
-->

<?php
session_start();
if(isset($_SESSION['ID']))
{
    session_destroy();
    session_start();
}
?>


<html>
    <head>
        <title>IIITR Hoodie- Login Page</title>
        <link rel = "stylesheet" type= "text/css" href = "CSS/index.css">
    </head>
    <body>
        <center>
            <h1>
                <br>Welcome to IIIT Ranchi winter hoodie selection Portal<br>
            </h1>
        
        <h2>
            Enter your Institute Registration number to continue
        </h2>
        <br><br>
        <h1>
        <div id="login">  
            <form method="POST" action="PHP_files/Choose.php">
                <label for="RegNo">Registration Number</label>
                <br> <br>
                <input  type="Text" name="ID" id="RegNo" size=18% required>
                <br><br>
                <button id="tf" type="submit"  formaction="PHP_files/Choose.php">Proceed</button>
            </form>
        </div>
        </h1>
        </center>
        <img src= "images/hoodie_s.jpg" id = "sample" alt = "Sorry,  This image could not be loaded.">
        <button type="submit" id="login1" onclick='location.href="PHP_files/login_admin.php";'>Admin Login<br>click here </button>
    </body>
</html>
