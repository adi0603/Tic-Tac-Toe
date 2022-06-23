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
$status='0';
require 'config.php';
$name=$_SESSION['name'];
$userid=$_SESSION['userid'];
$email=$_SESSION['email'];
$oppo_userid=$_SESSION['oppoUserId'];
$room_code=$_SESSION['roomCode'];

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

$result1 = mysqli_query($con,"select start from game where room_code='$room_code' and userid='$userid'");
$fetch1 = mysqli_fetch_array($result1);
$start=$fetch1['start'];
if ($start==1) {
  ?>
  <script type="text/javascript">
  window.location.replace("http://tictactoe.adipandey.in/gameboard_send.php");
  </script>
  <?php
}
else{
    ?>
    <div class="card" >
                <header class="card__header" style="background-color: #e36c4c;">
                   <div class="card__img">
                      <img src="image/clock.gif" width="150px" height="150px" alt="avatar" />
                   </div>
                   <div class="card__name">
                     <?php 
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
                     <h6><?php echo $fname; ?> <span style="color: white;">VS</span> <?php echo $fname1; ?></h6>
                      <h4>Waiting for other user to accept your request...</h4>
                      <center><p>You will be automatically redirected...</p></center>
                   </div>
                </header>
             </div>
    <?php
}
?>