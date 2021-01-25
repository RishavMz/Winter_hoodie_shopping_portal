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
  <link rel="stylesheet" href="../CSS/bootstrapcdn.css">
  <link rel="stylesheet" href="../CSS/index.css">
  <link rel="stylesheet" href="../CSS/mascot.css">
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
    <div class = "row">
    <div class = "col"><center>
      <div class = "card" style="width:18rem; border-radius: 12px;">
        <form method = "POST" action = "login.php">
          <br/>
          <label for="email">Email</label>
          <br/><Input type="text" name="email" placeholder="email" required/><br/><br/><br/>
          <label for="password">Password</label>
          <br/><Input type="password" name="password" placeholder="password" required/><br/><br/><br/>
          <label for="remember">Remember Me</label>
          <Input type="checkbox" name="remember" value="rem"/><br/>
          <button class = "btn btn-link" name="forgot" onClick = "alert('API service for OTP sending and verification is down at the moment. We regret the inconvenience')" >Forgot Password</button><br/><br/>
          <button type="submit" class = "btn btn-success" name="submit"  >Log In</button><br/><br/>
      </form></div></center>
    </div>
    <div class = "col">
      <center>
      <div class = "mascot">
        <img class = "mascot" src = "../figures/mascot1.png"/>
      </div>
    </center>
    </div>
    </div>
    
</body>
</html>



<?php  


//        validating OTP to verify mobile number on forgot password
//
//      echo ' <div class="container-fluid otp-background">
//      <div class="row">
//      <div class="col-6 text-center text-white"><p>Please Verify your Phone Number to verify your identity.<br></div>
//      <div class="col-6 text-center text-white">
//      <form action ="\index.php" method="post">
//      <div >
//      Enter OTP sent to number '.$phoneno.'<br>
//      <input type="number" min="0000" max="9999" name="OtP">
//      <input type="text" readonly value="'.$_POST['phoneno'].'" name = "phoneno">
//      <input type="submit" value="validateOtP" name="validateOtP">
//      </div>
//      </form>
//      </div>
//      </div>
//      </div>



//            Forgot Password Code
//
//    if(isset($_POST['validateOtPFFF']))
//    {
//        if($_POST['OtPF'] == $_SESSION['forgotOTP'])
//        {
//            echo'<div class="container-fluid otp-background">
//    	          <div class="row">
//    	          <div class="col-6 text-center text-white"><p>Please enter a new password for your account.</p></div>
//    	          <div class="col-6 text-center text-white">
//    	          <form action ="\index.php" method="post">
//    	        <div>
//    	        Enter new password<br>
//    	        <input type="text" minlength = "8" name="npass">
//    	        <input type="text" readonly value="'.$_POST['phonefor'].'" name = "phonefor">
//    	        <input type="submit" value="Set Password" name="npassw">
//    	        </div>
//    	        </form>
//    	          </div>
//    	          </div>
//    	          </div>';
//        }
//        else
//        {
//            echo '<script>alert("Wrong OTP !!! ");</script>';
//        }
//    }
//    
//    if(isset($_POST['forgot']))
//    {
//        $server = "localhost";
//    	$username = "root";
//    	$password = "";
//    	$con = mysqli_connect($server,$username, $password);
//    	if(!$con){
//    		die("Connection Not Created Error in Backend Part");
//    	}
//    	else{
//    	}
//    
//    	$mob = strval($_POST['numberforgot']);
//    		try {
//                   $pdo = new PDO("mysql:host=localhost;dbname=db",'root','');
//                   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//               }
//               catch(PDOException $e) {
//                   echo "Error: " . $e->getMessage();
//               }
//    				   $sql="select count(*) from `users` where phone = (:phone) " ;
//                               $stmt = $pdo->prepare($sql); 
//                               $stmt->execute(array( ':phone' => $mob));
//    							$rows = $stmt->fetchColumn();
//        if ($rows == 1) {
//        
//            $otp = rand(1000, 9000);
//        $link = "https://api.msg91.com/api/sendotp.php?authkey=".$apik."&mobile=91".$_POST['numberforgot']."&message=Your%20otp%20is%20".$otp."&sender=ABCDEF&otp=".$otp;
//         $xml = file_get_contents($link);
//        $_SESSION['forgotOTP'] = $otp;
//         echo'<div class="container-fluid otp-background">
//    	          <div class="row">
//    	          <div class="col-6 text-center text-white"><p>Please Verify your Phone Number </p></div>
//    	          <div class="col-6 text-center text-white">
//    	          <form action ="\index.php" method="post">
//    	        <div>
//    	        Enter OTP sent to number '.$mob.'<br>
//    	        <input type="number" min="0000" max="9999" name="OtPF">
//    	        <input type="text" readonly value="'.$_POST['numberforgot'].'" name = "phonefor">
//    	        <input type="submit" value="validate" name="validateOtPFFF">
//    	        </div>
//    	        </form>
//    	          </div>
//    	          </div>
//    	          </div>';
//        }
//        else
//        {
//            echo '<script>alert("Not a verified number '.$mob.'");</script>';
//        }
//        
//    }

?>