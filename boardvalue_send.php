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
$userid=$_SESSION['userid'];
$room_code=$_SESSION['roomCode'];
$value=$_POST['value'];
if($value=="cell_1"){
  $result = mysqli_query($con,"Update game set cell_1='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_2"){
  $result = mysqli_query($con,"Update game set cell_2='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_3"){
  $result = mysqli_query($con,"Update game set cell_3='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_4"){
  $result = mysqli_query($con,"Update game set cell_4='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_5"){
  $result = mysqli_query($con,"Update game set cell_5='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_6"){
  $result = mysqli_query($con,"Update game set cell_6='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_7"){
  $result = mysqli_query($con,"Update game set cell_7='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_8"){
  $result = mysqli_query($con,"Update game set cell_8='x' where room_code='$room_code' and userid='$userid'");
}
elseif($value=="cell_9"){
  $result = mysqli_query($con,"Update game set cell_9='x' where room_code='$room_code' and userid='$userid'");
}
$result = mysqli_query($con,"Update game set turn='2' where room_code='$room_code' and userid='$userid'");
$con->close();
?>