<?php
session_start();
require_once "../PHP_files/pdo.php";

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
    <title>Admin Section</title>
</head>
<body>
<br/>  
<div class = "container">
  <div class = "card"><center>
  <br/><br/><br/>
<div class = "card"style="width: 20rem;">
<form method='post' action='' enctype='multipart/form-data'>
    <h5><b>PRODUCT IMAGE:</b></h5><br/><br/>
  	<input type='file' name='files[]' multiple /><br/><br/>
  	<input type='submit' value='Submit' name='submit' /><br/><br/><br/><br/>
</form></div><br/><br/><br/><div class = "card"style="width: 20rem;">
<form action = "addproduct.php" method="POST">
    <h5><b>PRODUCT NAME:</b></h5><br/>
    <input type = "text" name = "name" placeholder = "Product name"/><br/><br/>
    <h5><b>PRICE:</b></h5><br/>
    <input type = "text" name = "price" placeholder = "Product price"/><br/><br/>
    <input type = "submit" name = "Add_Item"/><br/><br/>
</form></div>
<br/><br/><br/><center>
</div></div>

</body>
</html>