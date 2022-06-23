<?php 
session_start();
if($_SESSION['userid'] == "")
{
  header('Location: index.php');
}
if($_SESSION['roomCode'] == "")
{
  header('Location: dashboard.php');
}
$status=0;
require 'config.php';
$name=$_SESSION['name'];
$userid=$_SESSION['userid'];
$email=$_SESSION['email'];
$room_code=$_SESSION['roomCode'];
$oppo_userid=$_SESSION['oppo_userid'];

$won=rand(1,5);
$lost=rand(1,5);
$draw=rand(1,5);
$_SESSION['won']=$won;
$_SESSION['lost']=$lost;
$_SESSION['draw']=$draw;

if (isset($_POST['play_again'])) {
  $result9 = mysqli_query($con,"Update game set turn='1',cell_1='0',cell_2='0',cell_3='0',cell_4='0',cell_5='0',cell_6='0',cell_7='0',cell_8='0',cell_9='0' where room_code='$room_code' and oppo_userid='$userid'");
}

$parts = explode(" ", $name);
if(count($parts) > 1) {
    $lname = array_pop($parts);
    $fname = implode(" ", $parts);
}
else
{
    $fname = $name;
    $lname = " ";
}


$result1 = mysqli_query($con,"select name from login where userid='$oppo_userid'");
$fetch1 = mysqli_fetch_array($result1);
$oppoName=$fetch1['name'];
$parts1 = explode(" ", $oppoName);
if(count($parts1) > 1) {
    $lname1 = array_pop($parts1);
    $fname1 = implode(" ", $parts1);
}
else
{
    $fname1 = $oppoName;
    $lname1 = " ";
}


?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="image/icon.png">
        <title>GAME | TIC-TAC-TOE</title>
        <link rel="stylesheet" href="css/board.css?rnd=123">
        <script type="text/javascript" src="js/board.js"></script>
        <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script type="text/javascript">
          $(document).ready(function(e) {
            var refresher = setInterval("update_content();", 100); 
          })
          function update_content(){  
            $.ajax({  
              url : "boarddata_receive.php",  
              type : "POST",  
              success:function(data){  
                  $("#game-screen").html(data);  
               }  
            });  
          } 
          function sent(cell_value){
            $.ajax
             ({
             type: "POST",
             url: "boardvalue_receive.php",
             data: "value="+cell_value,
                
             });
          }
        </script>
    </head>

    <body >          
        <center>
            <h2>Game Board - <span style="color: #ffcc00;;">Tic</span> <span style="color: #999999">Tac</span> <span style="color: #3399ff;">Toe</span></h2><br>
            <h4><a href="endgame.php" style="text-decoration: none; color: black;"><i class="fas fa-arrow-left"></i>&nbsp;Exit</a></h4>
          </center>
            
            <center>
            <h3><?php echo $fname ; ?> <i class="fab fa-vimeo-v"></i><i class="fab fa-stripe-s"></i>&nbsp;<?php echo $fname1 ; ?> </h3>
        </center>
        <div id="game-screen" class="center">
          
        </div>
        <br>
          <center><p style="font-size: 15px;">Design & developed by <br><span style="color: blue;">Aditya Pandey</span></p></center>

        <audio id="myAudio" >
          <source src="sound/tick.mp3" type="audio/mpeg">
        </audio>
        <script type="text/javascript">
          function button_press(cell_value){
            document.getElementById(cell_value).innerHTML="o";
            playAudio();
            sent(cell_value);
          }
          
          function playAudio() { 
            var x = document.getElementById("myAudio");
            x.play(); 
          }
        </script>


      </body>
</html>

