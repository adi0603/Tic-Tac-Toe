<?php 
session_start();
if(isset($_GET['r'])){
	// Create connection
	include "connection.php";
	$conn = new mysqli($server, $username, $password);
	$sql = "select * from ".$dbname.".requests";
	$result = $conn->query($sql);
	echo '<table class="table table-bordered table-dark"> <tr > <th> ID </th><th> Name</th><th>Press To Play</th>';
	if($result->num_rows>0){
		while ($row = $result->fetch_assoc()){
			if($_SESSION['Id'] == $row['recieverid']){
				echo "<tr>";
				echo "<td>".$row['senderid']."</td>";
				echo "<td>".$row['sendername']."</td>";
				echo "<td>".'<form action="recieve.php" method="post"><input type="hidden" name="requestid" value="'.$row['requestid'].'"> <button type="submit" class="btn btn-info">Accept</button></form>'."</td>";
				echo "</tr>";	
			}
		}
	}
	echo "</table>";
	// this loads online users on page load
	
}
?>

