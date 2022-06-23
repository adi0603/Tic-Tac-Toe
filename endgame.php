<?php 
session_start();
if($_SESSION['userid'] == "")
{
  header('Location: index.php');
}
unset($_SESSION["roomCode"]);
header('Location: dashboard.php');
?>