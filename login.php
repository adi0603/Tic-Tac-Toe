<?php 
session_start();
$status=0;
require 'config.php';

//For Sign Up...

function sendOtp($otp,$email,$name){
  ini_set( 'display_errors', 1 );
   error_reporting( E_ALL );
   $from = "verification@tictactoe.adipandey.in";
   $to = $email;
   $subject = "Login OTP Verification";
   $message = '
     Hi '.$name.', Please use this code '.$otp.' to login to your account.
   ';
  // The content-type header must be set when sending HTML email
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
   $headers = "From:" . $from;
   mail($to,$subject,$message, $headers);
}

if (isset($_POST['signup'])) {
  $email=$_POST['email'];
  $name=$_POST['name'];
  $ip_addr=getenv("REMOTE_ADDR");
  $dandt=date("d-m-Y")." ". date("h:i:s A");
  $result = mysqli_query($con,"SELECT id FROM login WHERE email='$email'");
  if ($result->num_rows < 1) {
    $userid=0;
    for ($i=0; $i <10 ; $i++) { 
      $userid=rand(100000,999999);
      $result = mysqli_query($con,"SELECT id FROM login WHERE userid='$userid'");
      if ($result->num_rows < 1) {
        break;
      }
    }
    $result = mysqli_query($con,"INSERT into login (userid,name,email) values ('$userid','$name','$email')");
    $result = mysqli_query($con,"INSERT into log (ip_addr,userid,logintime) values ('$ip_addr','$userid','$dandt')");
    $_SESSION['userid']=$userid;
    $_SESSION['email']=$email;
    $_SESSION['name']=$name;

    $otp = rand(100000, 999999); //generates random otp
    $_SESSION['session_otp'] = $otp;  // stores the otp into a session variable
    $timestamp =  $_SERVER["REQUEST_TIME"];  // generate the timestamp when otp is forwarded to user email/mobile.
    $_SESSION['time'] = $timestamp;          // save the timestamp in session varibale for further use.

    sendOtp($otp,$email,$name);

    header('Location: otpverification.php');
  }
  else
  {
      $status=1;
  }
}


//For Sign In...


if (isset($_POST['login'])) {
  $email=$_POST['email'];
  $ip_addr=$_SERVER["REMOTE_ADDR"];
  $dandt=date("d-m-Y")." ". date("h:i:s A");
  $result = mysqli_query($con,"SELECT userid,name FROM login WHERE email='$email'");
  if ($result->num_rows > 0) {
    $fetch = mysqli_fetch_array($result);
    $userid=$fetch['userid'];
    $result = mysqli_query($con,"INSERT into log (ip_addr,userid,logintime) values ('$ip_addr','$userid','$dandt')");
    $_SESSION['userid']=$userid;
    $name=$fetch['name'];
    $_SESSION['name']=$fetch['name'];

    $_SESSION['email']=$email;

    $otp = rand(100000, 999999); //generates random otp
    $_SESSION['session_otp'] = $otp;  // stores the otp into a session variable
    $timestamp =  $_SERVER["REQUEST_TIME"];  // generate the timestamp when otp is forwarded to user email/mobile.
    $_SESSION['time'] = $timestamp;          // save the timestamp in session varibale for further use.

    sendOtp($otp,$email,$name);

    header('Location: otpverification.php');
  }
  else
  {
      $status=2;
  }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="image/icon.png">
        <title>Login | TIC-TAC-TOE</title>
        <link rel="stylesheet" href="css/login.css?rnd=123">
        <script type="text/javascript" src="js/index.js"></script>
        <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/test.js"></script>
        <link rel="stylesheet" type="text/css" href="css/test.css">
    </head>
    <body>
      <?php
        if($status==2){
          ?>
          <script type="text/javascript">
            toastr["error"]("Your account doesn't exist. Please use Sign Up Section!", "Error!");
          </script>
          <?php
        }
        elseif ($status==1) {
          ?>
          <script type="text/javascript">
            toastr["error"]("Your already created your account. Please use Sign In Section!", "Error!");
          </script>
          <?php
        }
      ?>
      <section>
        <div class="container">
          <div class="user signinBx">
            <div class="imgBx"><img src="image/testicon.jpg?rnd=123" width="100px" height="100px" alt="" /></div>
            <div class="formBx">

              <form action="" method="POST">
                <center>
                    <img src="image/icon.png" width="50px" height="50px">
                </center>
                <h2>Sign In</h2>
                <input type="email" name="email" placeholder="Enter your email..." required />
                <input type="submit" name="login" value="Log In" />
                <p class="signup">
                  Don't have an account ?
                  <a href="#" onclick="toggleForm();">Sign Up</a>
                </p>
                <center>
                    <p>
                        <span>Design & Developed By</span><br><span><a href="https://adipandey.in/" target="_blank" style="text-decoration: none; color: orangered;">Aditya Pandey</a><br>&copy;&nbsp;<?php echo date("Y"); ?></span>
                    </p>
                </center>
              </form>
            </div>
          </div>
          <div class="user signupBx">
            <div class="formBx">
              <form action="" method="POST">
                <center>
                    <img src="image/icon.png" width="50px" height="50px">
                </center>
                <h2>Create an account</h2>
                <input type="text" name="name" placeholder="Enter your name..." required />
                <input type="email" name="email" placeholder="Enter your email..." required />
                <input type="submit" name="signup" value="Sign Up"/>
                <p class="signup">
                  Already have an account ?
                  <a href="#" onclick="toggleForm();">Sign In</a>
                </p>
                <center>
                    <p>
                        <span>Design & Developed By</span><br><span><a href="https://adipandey.in/" target="_blank" style="text-decoration: none; color: orangered;">Aditya Pandey</a><br>&copy;&nbsp;<?php echo date("Y"); ?></span>
                    </p>
                </center>
              </form>
            </div>
            <div class="imgBx"><img src="image/testicon.jpg?rnd=123" alt="" /></div>
          </div>
        </div>
      </section>

      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </body>
</html>
