<!-- Author: RishavMz
    This php file would allow the students to enter their details which will
    thereby get updated in the mysql database.
    This file consists of an upper php part , a middle html part , and a lower css part.
    Basically , this is where the editting is redirected.
-->

<?php
require_once "pdo.php";
session_start();
if(! isset($_SESSION['ID']) && !isset($_POST['ID'])){
    header("Location:GoAway.html");
    return;
}
if (isset($_POST["ID"])){
    $_SESSION['ID'] = htmlentities($_POST['ID']);
    $sql = "SELECT count(*) FROM STUDENTS WHERE ID = (:ssn);";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute(array(':ssn' => $_SESSION['ID']));
    $rows = $stmt->fetchColumn();
    if ($rows ==0) {
            $sql = "INSERT INTO students (id) VALUES (:id)";
            $stmt = $pdo->prepare($sql); 
            $stmt->execute(array(':id' => $_SESSION["ID"]));
    }         
}
if ( isset($_POST['NAME']) && isset($_POST['COLOUR']) 
     && isset($_POST['SIZE']))
{   $var=0;
    $sql = "SELECT * FROM STUDENTS WHERE ID = (:ssn);";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute(array(':ssn' => $_SESSION['ID']));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ( $rows as $row ){
        $var = $row['STATE'];
        break;
    }
    if ($var != "COMPLETE"){
    $sql = "UPDATE students SET name = :name , colour = :colour , size = :size WHERE STUDENTS.ID =(:id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':name' => htmlentities($_POST['NAME']),':colour' => $_POST['COLOUR'],':size' => $_POST['SIZE'],':id' => $_SESSION['ID']));
    }
}
$stmt = $pdo->query("SELECT * from students");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
        <title>
            IIITR Hoodie- Selection Page
        </title>
        <link rel = "stylesheet" type= "text/css" href = "../CSS/Choose.css">
    </head>
    <body >
        <div id="nav">
            <a id="link1" href="../index.php"><b>Log Out</b></a>
            <script>
                function function2()
                {
                    alert("Careful \nAfter clicking on Complete order, NO FURTHER CHANGES will be made")
                }
            </script>
            <a id="link2" href="Cart.php" onclick=function2();><b>View Cart</b></a>
            <img id="img_nav"src="https://upload.wikimedia.org/wikipedia/en/f/fa/Indian_Institute_of_Information_Technology_Ranchi_Logo.svg" alt="N0 Internet">
            <span id="regno"><b>Welcome <?php echo htmlentities($_SESSION["ID"]) ?></b></span>
        </div>
        <h2>
        <marquee style="color:red;font-size:large;font-weight:normal" direction = "right" behavior = "alternate">
        Please pay the amount for hoodie (Rs. 430) through GOOGLE PAY to number XXXXXXXXXX.</marquee>
            
            <center>
                <br>
            Please Enter your details below:<br><br><br>
            </center>
        </h2>
        <h3>
            <form method="POST" id="form" action="Choose.php">
                <p class="lab">
                    <label for="Nam">Please enter your Name:</label><br><br>
                    <input type="text" name="NAME" id="Nam" size=25% required>
                </p>
                <p class="lab1">
                    <label for="color">Please select a colour</label><br><br>
                    <input id="b1" type="radio" name="COLOUR" value='black' checked>Black<br>
                    <input id="b1"type="radio" name="COLOUR" value='blue'>Dark Blue<br>
                    <input id="b1"type="radio" name="COLOUR" value='maroon'>Maroon<br>
                </p>
                <p class="lab">
                    <label for="siz">Please select your size</label>
                    <select name="SIZE" id="siz">
                        <option value="XXL">XXL</option>
                        <option value="XL">XL</option>
                        <option value="L">L</option>
                        <option value="M" selected>M</option>
                        <option value="S">S</option>
                        <option value="XS">XS</option>
                    </select>
                </p> 
                <script>
                    function function1()
                    {
                        alert("Click on view cart to view your order");
                    }
                </script>
            <button id="button" type="submit"  formaction="Choose.php" onclick="function1();">SAVE</button>
            </form>
        <img class= "zoom" src="../images/hoodie_black.jpeg" alt="Sorry, due to some problems the image is not available."  >
        <div id="SAMPLE">Sample design:</div>
        <div id="zm">Hover over the image to zoom</div>
        <br>
            
        </h3>
        <div id = "price">
        Rs. 430
        </div>
        <center>
<span id="RM" style="color:black;font-style:italic;">------------Made by Rishav Mazumdar-------------</span>
</center>
    </body>
</html>
