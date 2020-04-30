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
            <form method="POST" action="Choose.php">
                <label for="RegNo">Registration Number</label>
                <br> <br>
                <input  type="Text" name="ID" id="RegNo" size=18% required>
                <br><br>
                <button id="tf" type="submit"  formaction="Choose.php">Proceed</button>
            </form>
        </div>
        </h1>
        </center>
        
        <button type="submit" id="login1" onclick='location.href="login_admin.php";'>Admin Login<br>click here </button>
    </body>
</html>

<style>
    body{
        background-image: radial-gradient(white,white,white,white, lightblue, cyan );
    }
    #login1{
        position:absolute;
        top: 600px;
        font-size:1.5em;
        font-weight:bold;
        left:100px;
        box-shadow: 10px 10px 10px rgba(0,0,0,0.5);
    }
    #login{
        border-radius:45px;
        width:500px;
        padding:50px ;
        margin: 50px;
        box-shadow: 0 0 60px rgba(0,0,0,0.5);
    }
    #RegNo{
        font-size:1em;
        text-align:center;
    }
    #tf{
        font-size:1em;font-weight:bold;
        font-family: 'Times New Roman',Georgia, Times, serif;
    }

</style>