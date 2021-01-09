<!--Author : RishavMz
    This page shows the users their entered name, colour and size of their choics, and state of their order.
    Users can edit their choices by clicking on Edit Responses , or finalize their order by clicking on Complete Order.
    Once Complete order is clicked , no further changes would be made to the database(for that particular student).
-->

<?php
require_once "pdo.php";
session_start();
if(! isset($_SESSION['ID'])){
    header("Location:GoAway.html");
    return;
}
$sql = "SELECT * FROM STUDENTS WHERE ID = (:ssn);";
$stmt = $pdo->prepare($sql); 
$stmt->execute(array(':ssn' => $_SESSION['ID']));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$name = NULL;
$size = NULL;
$colour = NULL;
$state = 'UNPAID';
foreach( $rows as $row ) {
    $name = $row['NAME'];
    $colour = $row['COLOUR'];
    $size = $row['SIZE'];
    $state = $row['STATE'];
    break;
}

?>
<html>
    <head>
        <title>
            IIITR Hoodie - Cart
        </title>
        <link rel = "stylesheet" type= "text/css" href = "../CSS/cart.css">
    </head>
    <body>
        <div id="nav">
            <a id="link1" href="../index.php"><b>Log Out</b></a>
            <span id="regno"><b>Welcome <?php echo $_SESSION['ID'] ?></b></span>
        </div>
        <br>
        <marquee style="color:red;font-size:large;" direction = "right" behavior = "alternate">
        Please pay the amount for hoodie (Rs. 430) through GOOGLE PAY to number XXXXXXXXXX.</marquee><br>
        <h1><span id="bs"></span> This is your cart. Here you can preview or  change your orders.</span></h1>
        <br>
        <h2>
            <center>
             <div id="pre">  <br> 
                =====================STUDENT DETAILS======================<br><br>
                        <label for = "regno" >Registration number  :    <?= $_SESSION['ID']; ?>  </label><br><br>
                        <label for = "name"  >Name        :    <?= $name; ?>  </label><br><br>
                        <label for = "color" >Colour      :    <?= $colour; ?>  </label><br><br>
                        <label for = "size"  >Size          :    <?= $size; ?>  </label><br><br>
                        <label for = "state">State        :    <?= $state; ?>  </label><br><br>
</div>          </center>
            <center>
                <br><br>
                <input type="button" class="button1" value="Edit Responses" onclick="location.href='Choose.php';">      
                <input type="button" class="button2" value="Complete Order" onclick="location.href='PDF.php';"
                <?php if($name==NULL or $size == NULL or $colour = NULL){ echo' disabled = disabled';}?> >      
            </center>
               
        </h2>
     <br>
        <center>
<span id="RM" style="color:black;font-style:italic;">------------Made by Rishav Mazumdar-------------</span>
</center>
    </body>
</html>
