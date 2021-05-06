<?php
session_start();
require_once "../PHP_files/pdo.php";


if(!(isset($_SESSION['admin4682'])))
{
    header('location:adminlogin.php');
}



$sql1234 = "SELECT * FROM ORDERDATABASE" ;
$stmt1234 = $pdo -> prepare($sql1234);
$stmt1234 -> execute(array());
$rows = $stmt1234->fetchAll(PDO::FETCH_ASSOC);


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
    <title>Admin Section</title>
</head>
<style>
  .item{
      height: 80px;
      width: 70%;
      padding: 15px 25px 25px 25px;
      margin-top: 20px;
      margin-bottom: 20px;
      border: 1px solid grey;
  }
  .admimg{
      height: 50px;
      width: auto;
  }
  .delete{
    background-color:red;
    color:white;
    border-radius:10px;
    padding: 5px 5px 5px 5px;
  }
  .item0{
    border:none;
  }
  @media only screen and (max-width: 480px) {
    .item{
      height:150px;
    }
    .delete{
      margin-top:20px;
    }
  }
</style>  
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="adminlogin.php"><img CLASS="logo" src = '../IMAGES/logo.png'></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
      </ul>
      <?php
      echo '
        <span class="navbar-text">
       <a class = "nav-link" href="addproduct.php"> ADD/REMOVE </a>
       </span>
       <span class="navbar-text">
       <a class = "nav-link" href="logout.php"> LOG OUT </a>
       </span>
       ';
       
    ?>
  </div>
  </nav>
<br/>  
<br/>
<center>
    <div class="row item item0">
        <div class="col"><b>ORDER ID</b></div>
        <div class="col"><b>AMOUNT</b></div>
        <div class="col"><b>CUSTOMER EMAIL</b></div>
    </div>
<?php
    foreach($rows as $row){
        $sql12345 = "SELECT * FROM USERS WHERE ID = :IDS" ;
        $stmt12345 = $pdo -> prepare($sql12345);
        $stmt12345 -> execute(array(':IDS'=>$row["USERID"]));
        $rows1 = $stmt12345->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class = "item row">
        <div class="col">'.$row["ORDERID"].'</div> 
        <div class="col">'.$row["PRICE"].'</div>
        <div class="col">'.$rows1[0]["EMAIL"].'</div> 
        </div>';
    }
?>
</center>

</div>
</html>