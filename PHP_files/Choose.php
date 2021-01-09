
<?php

require_once "pdo.php";
session_start();

if(isset($_POST['submit']) && isset($_SESSION['email']) && isset($_SESSION['ID']))
{
  $sql1 = "SELECT * FROM USERS WHERE EMAIL = :EM";
  $stmt1 = $pdo->prepare($sql1); 
  $stmt1->execute(array(':EM' => $_SESSION['email']));
  $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

  $sql2 = "SELECT * FROM PRODUCTS WHERE IMAGE = :IK";
  $stmt2 = $pdo->prepare($sql2); 
  $stmt2->execute(array(':IK' => $_SESSION['ID']));
  $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

  $sql = "INSERT INTO ORDERS(USERID , PRODUCTID , SIZE , COLOUR , QUANTITY) VALUES (:A1 , :A2 , :A3 , :A4 , :A5)";
  $stmt = $pdo->prepare($sql); 
  $stmt->execute(array(':A1'=>$rows1[0]['ID'] , ':A2'=>$rows2[0]['ID'] , ':A3'=>htmlentities($_POST['size']) , ':A4'=>htmlentities($_POST['colour']) , ':A5'=>htmlentities($_POST['quantity'])));
}


if(isset($_GET['id'])){
  $_SESSION['ID'] = $_GET['id'];
$sql = "SELECT * FROM IMAGES WHERE ID = :ID";
$stmt = $pdo->prepare($sql); 
$stmt->execute(array(':ID' => $_GET['id']));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql1 = "SELECT * FROM PRODUCTS WHERE IMAGE = :ID";
$stmt1 = $pdo->prepare($sql1); 
$stmt1->execute(array(':ID' => $_GET['id']));
$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
}
else{
    header('Location:../index.php');
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
    <title>Winter hoodie collection</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src = 'IMAGES/logo.png'></a>
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
            <br/><br/>
            <div class = "row">
              <div class = "col"><center>
                <div class = "card" style="width: 18rem">
                    <?php  echo '<img src = "'.$rows[0]['PATH'].'" alt = "Product image"/>'  ?>
              </div>
            <h2>PRICE : <?php echo $rows1[0]['PRICE'];?></center>
            </div>
        <div class = "col">
          <div class = "container">
            <div class = "card">
              <center>
                <form method="POST" action="Choose.php">  
                <div class = "card" style = "width: 20rem">
                <label for="size">SIZE:</label>
                <select name = "size">
                    <option value="XXL">XXL</option>
                    <option value="XL">XL</option>
                    <option value="L">L</option>
                    <option value="M">M</option>
                    <option value="S">S</option>
                    <option value="XS">XS</option>
                    <option value="XXS">XXS</option>
                </select>
                <label for="colour"><br/><br/>COLOUR:</label>
                <select name = "colour">
                    <option value="black">Black</option>
                    <option value="blue">Blue</option>
                    <option value="maaroon">Maroon</option>
                    <option value="red">Red</option>
                    <option value="yellow">Yellow</option>
                    <option value="white">White</option>

                </select>
                <label for = 'quantity'><br/><br/>QUANTITY:</label>
                <input type = 'number' name = 'quantity' min='1' max='10' value='1' required/>
                </div>
                <br/><br/><button type="submit" class = "btn btn-primary" name="submit"  >Add To Cart</button><br/><br/>
                </form>
              </center>      
            </div>
          </div>
        </div>
      </div>  
    </body>
</html>