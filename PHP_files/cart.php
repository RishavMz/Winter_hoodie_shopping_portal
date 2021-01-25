
<?php

require_once "pdo.php";
session_start();

if(!isset($_SESSION['booked']))
{
    header('location:../index.php');
}
if(isset($_POST['confirm']))
{           
        $pp = 0;
        foreach ($_SESSION['cart'] as $items){
            $pp = $pp +(int)$items['price'];
        }
        $sql1 = "INSERT INTO ORDERDATABASE(PRICE , USERID) VALUES (:A1 , :A2 )";
        $stmt1 = $pdo->prepare($sql1); 
        $stmt1->execute(array(':A2'=>$_SESSION['cart'][0]['userid'] , ':A1'=>$pp ));
        $sql2 = "SELECT MAX(ORDERID) FROM ORDERDATABASE";
        $stmt2 = $pdo->prepare($sql2); 
        $stmt2->execute(array());
        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        
    foreach ($_SESSION['cart'] as $items){
        $sql = "INSERT INTO ORDERS(USERID , PRODUCTID , SIZE , COLOUR , QUANTITY,ORDERID) VALUES (:A1 , :A2 , :A3 , :A4 , :A5, :A6)";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute(array(':A1'=>$items['userid'] , ':A2'=>$items['productid'] , ':A3'=>$items['size'], ':A4'=>$items['colour'] , ':A5'=>$items['quantity'] , ':A6'=>$rows2[0]['MAX(ORDERID)']));
    }
    header('Location:PDF.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../CSS/bootstrapcdn.css">
  <link rel="stylesheet" href="../CSS/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Winter hoodie collection-cart</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../index.php"><img CLASS="logo" src = '../IMAGES/logo.png'></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
          </ul>
          <?php
            if(isset($_SESSION["email"]))
            {
                echo '
                    <span class="navbar-text">
                    <a class = "nav-link" href="../index.php"> Homepage </a>
                    </span>
                    <span class="navbar-text">
                    <a class = "nav-link" href="profile.php">Welcome '.$_SESSION["firstname"].'</a>
                    </span>
                    <span class="navbar-text">
                        <a class = "nav-link" href="logout.php">Log Out</a>
                    </span>';
            }
            else
            {
                echo'
                <span class="navbar-text">
                    <a class = "nav-link" href="../index.php"> Homepage </a>
                    </span>
                <span class="navbar-text">
                    <a class = "nav-link" href="login.php">Log In</a>
                </span>
                <span class="navbar-text">
                    <a class = "nav-link" href="signup.php">Sign Up</a>
                </span>';
            }
          ?>
        </div>
      </nav>
      <?php
            if($_SESSION['booked'] == 0){
                echo '<br/><br/><br/><center><h1>Your Cart is Empty.</h1></center>';
            }
            else
            {
                echo '<p><br><br></p>';
                echo '<div class = "container"><div class = "card card123">';
                echo '<div class = "row"><div class = "col"><b>Product Name</b></div><div class = "col"><b>Colour</b></div><div class = "col"><b>Quantity</b></div><div class = "col"><b>Price</b></div></div><br><br>';
                echo '<p></p>';
                foreach ($_SESSION['cart'] as $items)
                {
                    echo '<div class = "row"><div class = "col">'.$items['productname'].'</div>';
                    echo '<div class = "col">'.$items['colour'].'</div>';
                    echo '<div class = "col">'.$items['quantity'].'</div>';
                    echo '<div class = "col">'.$items['price'].'</div></div>';
                }
                echo '</div></div>';
            }
            echo '<p><br></p>';
            if(sizeof($_SESSION['cart'])>0)
                echo '<center><form method="POST" action="cart.php"><button type="submit" name="confirm" class = "btn btn-primary" >Confirm Order</button></form></center>';
      ?>
    </body>
</html>