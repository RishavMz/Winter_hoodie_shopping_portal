<!--
    Author: RishavMz
    This is the page which updates the payment data into the students table.
    The admin may access this page and updates the list of students who have made their payment for the hoodie.
-->
<?php
require_once "pdo.php";
session_start();
if(! isset($_SESSION['admi'])){
    header("Location:GoAway.html");
    return;
}
if (isset($_POST["ID"])){
    $sql = "UPDATE students SET paid = 'DONE' WHERE STUDENTS.ID =(:id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_POST['ID']));
    header("Location:admin.php");
    return;   
}
?>

<html>
    <head>
        <title>
            IIITR Hoodie- Admin udpade page Page
        </title>
        
    </head>
    <body>
    <link rel = "stylesheet" type= "text/css" href = "../CSS/add.css">
    <br><br><BR>
        <a id="link2" href="login_admin.php"><b>Log Out</b></a>
            <center>
        <h1>
            <form method="POST" id="form" >
                <p class="lab">
                    <label for="Nam">Please enter Registration number:</label><br><br>
                    <input type="text" name="ID" id="Nam" size=35% required>
                </p>
                <button type="submit" id="b">Submit</button>
                
                <br><br></form>
                <br><br>
                </h1>
        </center>
        
    </body>
</html>
