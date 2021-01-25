<?php
session_start();
require_once "pdo.php";
$salt = 'a59a0e0fcfab450008571e94a5549225';
if(isset($_POST['email']))
{

    $sql = "select * from users where email = (:em) ;";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute(array(':em' => htmlentities($_POST['email']) ));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row)
    {
      header("Location:signup.php?err=1");
      break;
    }
      if($_POST['password'] != $_POST['cpassword'])
      {
        header("Location:signup.php?err=2");
      }
      else{
      $sql = "insert into users (firstname , lastname , email , mobile , password) values ((:fn) , (:ln) , (:em) , (:mb) , (:ps)) ;";
      $stmt = $pdo->prepare($sql); 
      $stmt->execute(array(':fn' => htmlentities($_POST['firstname']) ,':ln' => htmlentities($_POST['lastname']) ,':em' => htmlentities($_POST['email']) ,':mb' => htmlentities($_POST['mobile']) ,':ps' => hash('gost',$_POST['password'].$salt) ));
      header("Location:signup.php?succ=1");
    
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
  <link rel = "stylesheet" href = "../CSS/mascot.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Sign Up</title>
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
                    <a class = "nav-link" href="login.php">Log In</a>
                </span>'
                ;
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
          echo '<div id = "error">User already registered with this email</div>';
        }
        else if($_GET['err'] == 2)
        {
          echo '<div id = "error">The given passwords do not match. Please try again</div>';
        }
      } ?>
      
      <?php
      if(isset($_GET['succ'])==1)
      {
        echo '<div id = "success">Successfully registered user</div>';
      } ?>
    </center>
    <br/><br/>

    <div class = "row">
    <div class = "col"><center>
    <div class = "card" style="width:18rem; border-radius: 12px;">
      <form method = "POST" action = "signup.php">
        <br/><label for="firstname">First Name</label>
        <br/><Input type="text" name="firstname" placeholder="firstname" required/>
        <br/><br/><label for="lastname"><br/>Lastname</label>
        <br/><Input type="lastname" name="lastname" placeholder="lastname" required/>
        <br/><br/><label for="email"><br/>Email</label>
        <br/><Input type="email" name="email" placeholder="email" required/>
        <br/><br/><label for="mobile"><br/>Mobile</label>
        <br/><Input type="number" name="mobile" placeholder="mobile" required/>
        <br/><br/><label for="password"><br/>Password</label>
        <br/><Input type="password" name="password" placeholder="password" required/>
        <br/><br/><label for="cpassword"><br/>Confirm Password</label>
        <br/><Input type="password" name="cpassword" placeholder="retype password" required/>
        <br/><br/><label for="gap"><br/><br/></label>
        <br/><button type="submit" class = "btn btn-success" name="submit"  >Create Account</button><br/>
        <br/><br/>
    </form>
    </div>
      </center>
    </div>
    <div class = "col">
      <center>
      <div class = "mascot">
      <img class = "mascot" src = "../figures/mascot2.png"/>
      </div>
    </center>
    </div>
    </div>


</body>
</html>

<?php


//              validating OTP to verify mobile number on sign up
//
//      if($result){
//        echo'<script>alert("Signup successful");</script>';
//      	    
//      }
//      }
//      else
//      {   
//          $_SESSION['signupretry'] = $_SESSION['signupretry']-1;
//          if($_SESSION['signupretry'] <= 0)
//          {
//              $s = "delete from  `db` . `users` where phone = '$phoneno'   ";
//      
//      $result = mysqli_query($con, $s);
//      
//        }
//        else{
//          echo ' <div class="container-fluid otp-background">
//                <div class="row">
//                <div class="col-6 text-center text-white"><p>Please Verify your Phone Number to complete your registeration.<br>Attempts left:'.$_SESSION['signupretry'].'</p></div>
//                <div class="col-6 text-center text-white">
//               <form action ="\index.php" method="post">
//              <div >
//              Enter OTP sent to number '.$phoneno.'<br>
//              <input type="number" min="0000" max="9999" name="OtP">
//              <input type="text" readonly value="'.$_POST['phoneno'].'" name = "phoneno">
//              <input type="submit" value="validateOtP" name="validateOtP">
//              </div>
//              </form>
//                </div>
//                </div>
//                </div>
//               
//              ';
//          }
//          
//      }
//      
//      
//      

//        Sending OTP for mobile number verification on sign up
//
//    $otp = rand(1000, 9000);
//    $link = "https://api.msg91.com/api/sendotp.php?authkey=".$apik."&mobile=91".$_POST['phoneno']."&message=Your%20otp%20is%20".$otp."&sender=ABCDEF&otp=".$otp;
//
//    $xml = file_get_contents($link);
//    $_SESSION['OtP'] = $otp;
//            //echo "<script>console.log('SESSION:".$_SESSION['OtP']."');</script>";
//    echo'<script>alert("Verify your phone number");</script>';
//	  $_SESSION['signupretry'] = 3;
//	  echo ' <div class="container-fluid otp-background">
//	          <div class="row">
//	          <div class="col-6 text-center text-white"><p>Please Verify your Phone Number to complete your registeration.</p></div>
//	          <div class="col-6 text-center text-white">
//	          <form action ="\signup.php" method="post">
//	        <div>
//	        Enter OTP sent to number '.$phoneno.'<br>
//	        <input type="number" min="0000" max="9999" name="OtP">
//	        <input type="text" readonly value="'.$_POST['phoneno'].'" name = "phoneno">
//	        <input type="submit" value="validateOtP" name="validateOtP">
//	        </div>
//	        </form>
//	          </div>
//	          </div>
//	          </div>
//	        ';
//


?>