<!--Author: RishavMz
    This page is a simple login page to enable admin login to view the details entered by the students.
-->

<?php
session_start();
if(isset($_SESSION['admi']))
{
    session_destroy();
    session_start();
}
?>


<html>
    <head>
        <title>IIITR Hoodie-Admin Login Page</title>
        <link rel = "stylesheet" type= "text/css" href = "..\CSS\login_admin.css">
    </head>
    <body>
        <center>
            <h1>
                <span id="info">
                <br>Please enter Username and Password to continue<br>
            </span>
            </h1>
        
        <h2>
            <br>
        </h2>
        <br>
        <h1>
        <div id="login">  
            <form method="POST" action="authentication.php">
                <label for="RegNo">Username</label>
                <br> <br>
                <input  type="Text" name="admi" id="RegNo" size=28% required>
                <br><br>
                <label for="RegNo">Password</label>
                <br> <br>
                <input  type="password" name="password" id="RegNo" size=28% required>
                <br><br>
                <button id="tf" type="submit"  formaction="authentication.php">Proceed</button>
            </form>
        </div>
        </h1>
        </center>
    </body>
</html>

