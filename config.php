<?php

	$con = mysqli_connect("localhost","u673770074_tictactoe","z*2[o0b]?G","u673770074_tictactoe");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
		}
	mysqli_set_charset($con, "utf8");
	date_default_timezone_set('Asia/Kolkata');	
	$error="";	
?>