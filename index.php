
<?php
session_start();
if(isset($_SESSION['ID']))
{
    session_destroy();
    session_start();    
}

require_once "PHP_files/pdo.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/index.css">
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
                echo '<span class="navbar-text">
                    <a class = "nav-link" href="PHP_files/profile.php">Welcome '.$_SESSION["firstname"].'</a>
                    </span>
                    <span class="navbar-text">
                        <a class = "nav-link" href="PHP_files/logout.php">Log Out</a>
                    </span>';
            }
            else
            {
                echo'<span class="navbar-text">
                    <a class = "nav-link" href="PHP_files/login.php">Log In</a>
                </span>
                <span class="navbar-text">
                    <a class = "nav-link" href="PHP_files/signup.php">Sign Up</a>
                </span>';
            }
          ?>
        </div>
      </nav>
      <script>
        function choose(id){
          location.href="PHP_files/choose.php?id="+id;
        }
      </script>
        <?php

        $sql = "select * from products;";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<br/><br/><div class = "container"><div class="card-columns">';
        foreach($rows as $row)
        {
          $sql12 = "select * from images where ID = :id;";
          $stmt12 = $pdo->prepare($sql12); 
          $stmt12->execute(array(':id'=>$row['IMAGE']));
          $rows12 = $stmt12->fetchAll(PDO::FETCH_ASSOC);
          echo '<div class="card">
          <img class="card-img-top" src="'.substr($rows12[0]['PATH'],3).'" alt="'.$rows12[0]['NAME'].'">
          <div class="card-body">
            <h5 class="card-title">'.$row['NAME'].'</h5>
            <p class="card-text">'.$row['PRICE'].'</p>
          </div>
          <div class="card-footer">
          <button type="submit" class = "btn btn-info" value="Add To Cart" onclick="choose('.$row['IMAGE'].')">Add To Cart</button>
        
          </div>
        </div>';
        }
        echo '</div></div>';

        ?> 
    </body>
</html>
