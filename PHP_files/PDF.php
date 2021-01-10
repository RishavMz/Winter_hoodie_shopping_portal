
<?php
require_once "pdo.php";
session_start();
if(!isset($_SESSION['booked']))
{
    header('location:../index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Winter hoodie collection-cart</title>
</head>
<body>
<?php 

    $sql1 = "SELECT * FROM USERS WHERE EMAIL = :EM";
    $stmt1 = $pdo->prepare($sql1); 
    $stmt1->execute(array(':EM' => $_SESSION['email']));
    $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    echo '<p><br><br><br></p>';
    echo '<div class = "container"><div class = "card"><p><br/><center><h5>Customer Details:</h5></center><br/></p>';
    echo '<div class = "card">';
    echo '<div class = "row"><div class="col">Customer Name</div><div class = "col">'.$rows1[0]["FIRSTNAME"].' '.$rows1[0]["LASTNAME"].'</div></div><p></p>';
    echo '<div class = "row"><div class="col">Customer Email</div><div class = "col">'.$rows1[0]["EMAIL"].'</div></div><p></p>';
    echo'</div>';
    echo '<p><br/><br/><center><h5>Products Ordered:</h5></center><br/></p><div class = "card">';
    echo '<div class = "row"><div class = "col"><b>Product Name</b></div><div class = "col"><b>Quantity</b></div><div class = "col"><b>Colour</b></div><div class = "col"><b>Price</b></div></div><br><br>';
    
    foreach ($_SESSION['cart'] as $items)
    {
        echo '<div class = "row"><div class = "col">'.$items['productname'].'</div>';
        echo '<div class = "col">'.$items['quantity'].'</div>';
        echo '<div class = "col">'.$items['colour'].'</div>';
        echo '<div class = "col">'.$items['price'].'</div></div>';
    }
    echo '</div></div></div>';
    echo '<p><br><br><br/><br></p>';

?><center>
<button type="submit" class = "btn btn-info" id="link1" onclick="window.print()">Print Recipt</button></center>
    </body>
</html>                 
