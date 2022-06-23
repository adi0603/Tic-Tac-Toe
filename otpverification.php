<?php 

session_start();
$status=0;
require 'config.php';
$email=$_SESSION['email'];
$userid=$_SESSION['userid'];

  if (isset($_POST['verifyotp'])) {
    $otp=$_POST['otp'];
    
     $timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp 
    if(($timestamp - $_SESSION['time']) > 300)  // 300 refers to 300 seconds
    {
        $status=1;  //otp is expired 
    }
    else{
        if ($otp == $_SESSION['session_otp']) 
        {
            unset($_SESSION['session_otp']);
            header('Location: dashboard.php');
        } 
        else {
            $status=2; //incorrect otp
        }
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
        <title>OTP Verification | TIC-TAC-TOE</title>
        <link rel="stylesheet" href="css/login.css?rnd=123">
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
            toastr["error"]("Incorrect OTP. Please try again!", "Error!");
          </script>
          <?php
        }
        elseif ($status==1) {
          ?>
          <script type="text/javascript">
            toastr["error"]("OTP has been expired. Please regenrate it!", "Error!");
          </script>
          <?php
        }
      ?>
      <section>
        <div class="container">
          <div class="user signinBx">
            <div class="imgBx"><img src="image/otp.jpg?rnd=123" alt="" /></div>
            <div class="formBx">

              <form action="" method="POST">
                <center>
                    <img src="image/icon.png" width="50px" height="50px">
                </center>
                <h2>OTP Verification</h2>
                <a href="index.php" style="text-decoration: none;color: black;"><i class="fas fa-arrow-left"></i>&nbsp;Back</a><br>
                <p>We have sent an OTP on below mail. Please check...<br><center><b><?php echo $email;?></b></center></p>
                <input type="number" name="otp" placeholder="Enter your OTP..." min="100000" max="999999" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required />
                <input type="submit" name="verifyotp" value="Verify OTP" />
                <center>
                    <p>
                        <span>Design & Developed By</span><br><span><a href="https://adipandey.in/" target="_blank" style="text-decoration: none; color: orangered;">Aditya Pandey</a><br>&copy;&nbsp;<?php echo date("Y"); ?></span>
                    </p>
                </center>
              </form>
            </div>
          </div>
        </div>
      </section>

      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </body>
</html>
