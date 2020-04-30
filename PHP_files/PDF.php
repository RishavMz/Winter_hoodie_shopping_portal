<!--Author : RishavMz
    This page is seen after order has been finalized.
    The user can see their details here, and the state of their order also becomes completed on this page.
    The users can take a print out of their order here by clicking on Print Recipt
-->


<?php
require_once "pdo.php";
session_start();
if(! isset($_SESSION['ID'])){
    header("Location:GoAway.html");
    return;
}
$sql = "UPDATE STUDENTS SET STATE = 'COMPLETE' WHERE ID = (:ssn);";
$stmt = $pdo->prepare($sql); 
$stmt->execute(array(':ssn' => $_SESSION['ID']));
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
            IIITR Hoodie - Complete order 
        </title>
        <link rel = "stylesheet" type= "text/css" href = "..\CSS\PDF.css">
    </head>
    <body>
    <div id="nav">
            <a id="link2" href="../Login_page.php"><b>Log Out</b></a>
            <img id="img_nav"src="https://upload.wikimedia.org/wikipedia/en/f/fa/Indian_Institute_of_Information_Technology_Ranchi_Logo.svg" alt="N0 Internet">
            <span id="regno"><b>Welcome <?php echo $_SESSION['ID'] ?></b></span>
        </div>
        <h2>
        <pre>
      
                        
             01010101    01010101    01010101    010101010101   01010101
                01          01          00           011        01    0101
                11          00          01           111        11    0001
                00          10          11           000        01  0101 
                01          11          10           011        010101
                00          00          11           100        01  0101
                10          01          01           010        11    0111 
             01010101    01010101    01010101        111        01      010       
                    </pre>
                    <pre>   
            =====================STUDENT DETAILS======================<br><br>
                <label for = "regno" >Registration number  :    <?= $_SESSION['ID']; ?>  </label><br><br>
                <label for = "name"  >Name                 :    <?= $name; ?>  </label><br><br>
                <label for = "color" >Colour               :    <?= $colour; ?>  </label><br><br>
                <label for = "size"  >Size                 :    <?= $size; ?>  </label><br><br>
                <label for = "state">State                :    <?= $state; ?>  </label><br><br>
                    </pre>
                    
</h2>

<button type="submit" id="link1" onclick="window.print()">Print Recipt</button>
    </body>
</html>                 
