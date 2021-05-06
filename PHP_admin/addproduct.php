<?php
session_start();
require_once "../PHP_files/pdo.php";


if(!(isset($_SESSION['admin4682'])))
{
    header('location:adminlogin.php');
}
$loc = '';
if(isset($_POST['submit'])){	
  // Count total files
  $countfiles = count($_FILES['files']['name']);
  if($loc == NULL)
  {
    $query1 = "INSERT INTO IMAGES( NAME , PATH)VALUES(?,?)";
    $statement = $pdo->prepare($query1);
    // Loop all files
    for($i=0;$i<$countfiles;$i++)
    {
      // File name
      $filename = $_FILES['files']['name'][$i];
      // Location
      $target_file = '../images/'.$filename;
      // file extension
      $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
      // Valid image extension
      $valid_extension = array("png","jpeg","jpg");
      if(in_array($file_extension, $valid_extension))
      {
        // Upload file
        if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file))
        {
          // Execute query
          $statement->execute(array($filename,$target_file));
        }
      }
    }
    $_SESSION['image'] = $target_file;
  }
  $sql123 = "SELECT MAX(ID) FROM IMAGES" ;
  $stmt123 = $pdo -> prepare($sql123);
  $stmt123 -> execute(array());
  $row123 = $stmt123->fetchAll(PDO::FETCH_ASSOC);
  $_SESSION['ADD_ID'] = $row123[0]['MAX(ID)'];
}

if(isset($_POST['Add_Item']))
{
  if(isset($_SESSION['ADD_ID']))
  {
    $sql123 = "INSERT INTO PRODUCTS (NAME,IMAGE,PRICE) VALUES( :N , :I , :P)" ;
    $stmt123 = $pdo -> prepare($sql123);
    $stmt123 -> execute(array(':N' => htmlentities($_POST['name']) , ':I' => $_SESSION['ADD_ID'] , ':P' => htmlentities($_POST['price'])));
  }
  else
  {
    $sql123 = "INSERT INTO PRODUCTS (NAME,IMAGE,PRICE) VALUES( :N , :I , :P)" ;
    $stmt123 = $pdo -> prepare($sql123);
    $stmt123 -> execute(array(':N' => htmlentities($_POST['name']) , ':I' => 8, ':P' => htmlentities($_POST['price'])));
  }
}

if(isset($_POST['remove'])){
  $sql12 = "SELECT * FROM ORDERS WHERE PRODUCTID = :ID " ;
  $stmt12 = $pdo -> prepare($sql12);
  $stmt12 -> execute(array(':ID' => htmlentities($_POST['id'])));
  $rows = $stmt12->fetchAll(PDO::FETCH_ASSOC);
  if(sizeof($rows)==0){
    $sql1234 = "DELETE FROM PRODUCTS WHERE ID = :ID " ;
    $stmt1234 = $pdo -> prepare($sql1234);
    $stmt1234 -> execute(array(':ID' => htmlentities($_POST['id'])));
    $sql123 = "DELETE FROM IMAGES WHERE ID = :IDs " ;
    $stmt123 = $pdo -> prepare($sql123);
    $stmt123 -> execute(array(':IDs' => htmlentities($_POST['remove'])));

  }
  else{
    echo '<script>alert("Cannot delete this item. A user has already bought this item.")</script>';
  }
  
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
       <a class = "nav-link" href="adminview.php"> VIEW ORDERS </a>
       </span>
       <span class="navbar-text">
       <a class = "nav-link" href="logout.php"> LOG OUT </a>
       </span>
       ';
       
    ?>
  </div>
  </nav>
<br/>  
<br/><?php 
if(isset($_POST['msg']))
{
  echo '<br/><br/><center><div id="success">'.$_POST['msg'].'</div></center>';
}
?>
<div class = "container"><br/><br/>
  <div class = "row">
  <br/><br/><br/><div class = "col"><center>
  <div class = "card"style="width: 20rem;">
    <form method='POST' action='' enctype='multipart/form-data'><br/>
        <h5><b>PRODUCT IMAGE:</b></h5><br/><br/>
        <input type='file' name='files[]' multiple /><br/><br/>
        <input type = 'text' name='msg' value = 'File uploaded successfully' hidden/>
        <input type='submit' value='Upload' name='submit' /><br/><br/>
    </form>
  </div><br/><br/><div id = "image"><?php
   if(isset($_SESSION['image'])){
     echo '<img src ="'.$_SESSION['image'].'" alt = "Selected image" style = "height: 100px;width:auto;">'; 
   }
   
   ?></div><br/></div><br/><br/></center>
  <div class = "col"><center><div class = "card"style="width: 20rem;">
<form action = "addproduct.php" method="POST"><br/><br/>
    <h5><b>PRODUCT NAME:</b></h5><br/>
    <input type = "text" name = "name" placeholder = "Product name"/><br/><br/>
    <h5><b>PRICE:</b></h5><br/>
    <input type = "text" name = "price" placeholder = "Product price"/><br/><br/>
    <input type = 'text' name='msg' value = 'Product added successfully' hidden/>
    <input type = "submit" name = "Add_Item"/><br/><br/>
</form></div></center>
<br/><br/><br/>
</div></div></div><center>
<div class="items container">
<?php
  $sql1234 = "SELECT * FROM PRODUCTS" ;
  $stmt1234 = $pdo -> prepare($sql1234);
  $stmt1234 -> execute(array());
  $rows = $stmt1234->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rows as $products) {
    $sql124 = "SELECT * FROM IMAGES WHERE ID = :ID" ;
    $stmt124 = $pdo -> prepare($sql124);
    $stmt124 -> execute(array(":ID"=> htmlentities($products["IMAGE"])));
    $row = $stmt124->fetchAll(PDO::FETCH_ASSOC);
    echo '
            <div class="item row">
            <div class="col"><img class="admimg" src="../images/'.$row[0]["NAME"].'" /></div>
            '.$products["NAME"].'   '.$products["PRICE"].'
            <div class="col"><form method="POST" action="addproduct.php">
            <input type="text" name="id" value="'.$products["ID"].'" hidden/>
            <input type="text" name="remove" value="'.$rows[0]["ID"].'" hidden/>
            <button class="delete">Delete</button></form></div>';   
    echo '</div>';   
  }
  ?>
  </div></center>
</body>
</html>