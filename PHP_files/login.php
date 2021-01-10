<?php
session_start();
require_once "pdo.php";
$salt = 'a59a0e0fcfab450008571e94a5549225';

if(isset($_COOKIE['email']) && isset($_COOKIE['firstname']))
{
  $_SESSION['email'] = $_COOKIE['email'];
  $_SESSION['firstname'] = $_COOKIE['firstname'];
  if(!(isset($_SESSION['booked']))){
    $_SESSION['booked'] = 0;
    $_SESSION['cart'] = [];
    $_SESSION['price'] = 0;
  }
}

if(isset($_POST['email'])){
  $sql = "select * from users where email = (:em) ;";
  $stmt = $pdo->prepare($sql); 
  $stmt->execute(array(':em' => htmlentities($_POST['email'])));
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($rows == 0)
  {
    header("Location:login.php?err=1");
  }
  else
  {

    $pass = $rows[0]['PASSWORD'];
    if (hash('gost',$_POST['password'].$salt) == $pass) {
      $_SESSION['email'] = htmlentities($_POST['email']);
      $_SESSION['firstname'] = $rows[0]['FIRSTNAME'];
      if(!(isset($_SESSION['booked']))){
        $_SESSION['booked'] = 0;
        $_SESSION['cart'] = [];
        $_SESSION['price'] = 0;
        if($_POST['remember'] = 'rem')
        {
          setcookie('email', $_SESSION['email'], time() + (86400 * 30), "/");
          setcookie('firstname', $_SESSION['firstname'], time() + (86400 * 30), "/");
        }
        //echo "Session set";
      }
      header("Location:../index.php");
    } 
    else{
      header("Location:login.php?err=2");
    } 
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
    <title>Log In</title>
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
              header("Location:../index.php");

            }
            else
            {
                echo'
                <span class="navbar-text">
                    <a class = "nav-link" href="../index.php"> Homepage </a>
                    </span>
                <span class="navbar-text">
                    <a class = "nav-link" href="signup.php">Sign Up</a>
                </span>';
            }
          ?>
        </div>
      </nav>
    <br/><br/><br/>
    <center>
    <?php if(isset($_GET['err']))
      {
        if($_GET['err'] == 1)
        {
          echo '<div id = "error">User not registered</div>';
        }
        else if($_GET['err'] == 2)
        {
          echo '<div id = "error">Incorrect password</div>';
        }
      } ?>
      </center>
    <br/><br/>
    <div class = "container">
      <div class = "card"><center>
        <div class = "card" style="width:18rem">
        <form method = "POST" action = "login.php">
        <label for="email">Email</label>
        <br/><Input type="text" name="email" placeholder="email" required/><br/><br/><br/>
        <label for="password">Password</label>
        <br/><Input type="password" name="password" placeholder="password" required/><br/><br/><br/>
        <label for="remember">Remember Me</label>
        <Input type="checkbox" name="remember" value="rem"/><br/><br/><br/>
        <button type="submit" class = "btn btn-primary" name="submit"  >Log In</button><br/>
    </form>
    </div></center></div>
    </div>
</body>
</html>