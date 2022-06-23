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
$won=$_SESSION['won'];
$lost=$_SESSION['lost'];
$draw=$_SESSION['draw'];
$result1 = mysqli_query($con,"select * from game where room_code='$room_code' and userid='$userid'");
$fetch1 = mysqli_fetch_array($result1);
$cell_1=$fetch1['cell_1'];
$cell_2=$fetch1['cell_2'];
$cell_3=$fetch1['cell_3'];
$cell_4=$fetch1['cell_4'];
$cell_5=$fetch1['cell_5'];
$cell_6=$fetch1['cell_6'];
$cell_7=$fetch1['cell_7'];
$cell_8=$fetch1['cell_8'];
$cell_9=$fetch1['cell_9'];
$turn=$fetch1['turn'];

$gameResult='0';

if (($cell_1 == 'x' and $cell_2 == 'x' and $cell_3 == 'x') or ($cell_4 == 'x' and $cell_5 == 'x' and $cell_6 == 'x') or
  ($cell_7 == 'x' and $cell_8 == 'x' and $cell_9 == 'x') or ($cell_1 == 'x' and $cell_5 == 'x' and $cell_9 == 'x') or
  ($cell_1 == 'x' and $cell_4 == 'x' and $cell_7 == 'x') or ($cell_3 == 'x' and $cell_6 == 'x' and $cell_9 == 'x') or
  ($cell_3 == 'x' and $cell_5 == 'x' and $cell_7 == 'x')  or ($cell_2 == 'x' and $cell_5 == 'x' and $cell_8 == 'x')) {
      $gameResult= 1;
} 
elseif (($cell_1 == 'o' and $cell_2 == 'o' and $cell_4 == 'o') or ($cell_4 == 'o' and $cell_5 == 'o' and $cell_6 == 'o')or
  ($cell_7 == 'o' and $cell_8 == 'o' and $cell_9 == 'o') or ($cell_1 == 'o' and $cell_5 == 'o' and $cell_9 == 'o')or
  ($cell_1 == 'o' and $cell_4 == 'o' and $cell_7 == 'o') or ($cell_3 == 'o' and $cell_6 == 'o' and $cell_9 == 'o')or
  ($cell_3 == 'o' and $cell_5 == 'o' and $cell_7 == 'o')  or ($cell_2 == 'o' and $cell_5 == 'o' and $cell_8 == 'o')){
      $gameResult= 2;
} 
elseif ($cell_1 != '0' and $cell_2 != '0' and $cell_3 != '0' and $cell_4 != '0' and $cell_5 != '0' and $cell_6 != '0' and
  $cell_7 != '0' and $cell_8 != '0' and $cell_9 != '0'){
      $gameResult= 3;
}


if($gameResult==1){
    ?>
    <center>
        <h1 style="color: dodgerblue;">You Won</h1>
        <img src="image/won/<?php echo $won; ?>.gif">
        <p>
        Play again or Move to dashboard by pressing Exit.
      </p>
      <form method="POST">
        <button type="submit" name="play_again" style="border-radius: 10px;color: white; background: dodgerblue;">PLAY AGAIN &nbsp; <i class="fas fa-gamepad"></i></button>
      </form>
      </center>
    <?php  
    $result = mysqli_query($con,"Update game set winner='1' where room_code='$room_code' and userid='$userid'");
}elseif($gameResult==2){
    ?>
    <center>
        <h1 style="color: tomato;">You Lost</h1>
        <img src="image/lost/<?php echo $lost; ?>.gif" >
        <p>
        Play again or Move to dashboard by pressing Exit.
      </p>
      <form method="POST">
        <button type="submit" name="play_again" style="border-radius: 10px; color: white; background: dodgerblue;">PLAY AGAIN &nbsp; <i class="fas fa-gamepad"></i></button>
      </form>
      </center>
    <?php
    $result = mysqli_query($con,"Update game set winner='2' where room_code='$room_code' and userid='$userid'");
}elseif($gameResult==3){
    ?>
    <center>
        <h1 style="color: orange;">You Played Draw</h1>
        <img src="image/draw/<?php echo $draw; ?>.gif" >
        <p>
        Play again or Move to dashboard by pressing Exit.
      </p>
      <form method="POST">
        <button type="submit" name="play_again" style="border-radius: 10px; color: white; background: dodgerblue;">PLAY AGAIN &nbsp; <i class="fas fa-gamepad"></i></button>
      </form>
      </center>
  <?php
  $result = mysqli_query($con,"Update game set winner='3' where room_code='$room_code' and userid='$userid'");
}
else{
  ?>
<table class="center">

            <tr>
              <td>
                <button type="button" class="cell" id="cell_1" onclick="button_press('cell_1');" <?php if($cell_1 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_1 !='0'){ echo $cell_1;} ?></button>
              </td>
              <td>
                <button type="button" class="cell" id="cell_2" onclick="button_press('cell_2');" <?php if($cell_2 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_2 !='0'){ echo $cell_2;} ?></button>
              </td>
              <td>
                <button type="button" class="cell" id="cell_3" onclick="button_press('cell_3');" <?php if($cell_3 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_3 !='0'){ echo $cell_3;} ?></button>
              </td>
            </tr>
            <tr>
              <td>
                <button type="button" class="cell" id="cell_4" onclick="button_press('cell_4');"<?php if($cell_4 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_4 !='0'){ echo $cell_4;} ?></button>
              </td>
              <td>
                <button type="button" class="cell" id="cell_5" onclick="button_press('cell_5');"<?php if($cell_5 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_5 !='0'){ echo $cell_5;} ?></button>
              </td>
              <td>
                <button type="button" class="cell" id="cell_6" onclick="button_press('cell_6');"<?php if($cell_6 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_6 !='0'){ echo $cell_6;} ?></button>
              </td>
            </tr>
            <tr>
              <td>
                <button type="button" class="cell" id="cell_7" onclick="button_press('cell_7');"<?php if($cell_7 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_7 !='0'){ echo $cell_7;} ?></button>
              </td>
              <td>
                <button type="button" class="cell" id="cell_8" onclick="button_press('cell_8');"<?php if($cell_8 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_8 !='0'){ echo $cell_8;} ?></button>
              </td>
              <td>
                <button type="button" class="cell" id="cell_9" onclick="button_press('cell_9');"<?php if($cell_9 !='0' || $turn ==2){ echo "disabled";} ?>><?php if($cell_9 !='0'){ echo $cell_9;} ?></button>
              </td>
            </tr>
          </table>
          <center>It's <?php if($turn==1){ echo "your";} else { echo "your friend's";} ?> turn.</center>

<?php
}
  $con->close();
?>