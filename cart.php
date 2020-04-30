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
    </head>
    <body>
        <div id="nav">
            <a id="link1" href="Login_page.php"><b>Log Out</b></a>
            <img id="img_nav"src="https://upload.wikimedia.org/wikipedia/en/f/fa/Indian_Institute_of_Information_Technology_Ranchi_Logo.svg" alt="N0 Internet">
            <span id="regno"><b>Welcome <?php echo $_SESSION['ID'] ?></b></span>
        </div>
        <br><br>
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
    </body>
</html>
<style>

    #nav{
        padding-top:20px;
        margin-left:100px;
        background-color: lightseagreen;
        color:white;
        height:35px;
    }
    #link1{
        text-decoration-line: none;
        color:white;
        font-size: 1.8em;
        position:absolute;
        top: 15px;
        right:100px;
    }
    #img_nav{
        height:60px;
        width:60px;
        position: absolute;
        left:30px;
        top: 5px;
    }
    #regno{
        text-decoration-line: none;
        color:white;
        font-size: 1.8em;
        position:absolute;
        top: 15px;
        left:150px;
    }
    
    #bs{
        padding-left: 10px;
    }
    .button1{
        font-size: 1em;
    }
    .button2{
        font-size: 1em;
        margin-left:50px;
    }
    #pre{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        border: 1px dashed black;
        width:70%;
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
    }
</style>