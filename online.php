<?php 
session_start();
if(!(isset($_SESSION['Name']))){
	header("Location: index.php"); /* this redirect user to index page if user is not logged in */
exit();
}
include 'connection.php'; // this file contains $server,$username,$password
// PHP script on challenge
if(isset($_POST['plrid'])){
$id = $_POST['plrid']; // get id of challenged player
$name ="";
$conn = new mysqli($server, $username, $password);
$sql = "SELECT * FROM ".$dbname.".`users` WHERE Id =".$id;
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		$name = $row['username']; // get the name of challenged player
	}
}
$sql = "select * from $dbname.requests";// select requests 
$result = $conn->query($sql);
$i = 0;
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){// check if the request is already sended.
	      if($row['senderid'] == $_SESSION["Id"] && $row['recieverid'] == $id){
			 $i=1;
			 break; 
		  }
	}
}
if($i == 0){// insert request in request table
$sql = "INSERT INTO ".$dbname.".`requests`(`senderid`, `sendername`, `recieverid`, `recievername`, `status`)  VALUES (".$_SESSION['Id'].",'".$_SESSION['Name']."',".$id.",'".$name."',false)";
$conn->query($sql) ;
}
	$sql = "SELECT requestid FROM ".$dbname.".`requests` WHERE senderid=".$_SESSION['Id']." and recieverid=$id";// get the id of request send
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	   $_SESSION['requestid'] = $row['requestid']; // set a session for request id
	   header("Location: challenge.php"); /* Redirect to challenge page */
exit();
}
}

$error = "";
   
// Create connection

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="images/icon.png">
<script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title><?php echo $_SESSION['Name'];?> - TIC TAC TOE</title>
<link href="css/bootstrap.css" rel="stylesheet">
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color:rgb(240, 240, 240);
  color: blue;
  text-align: center;
}
</style>
</head>
<body style="background:#646BF4; color:white;">
<nav class="navbar navbar-default">
    <div class="container-fluid"> 
      <h1><img src="images/logo.png" height="30px" width="120px"></h1>
      <button type="button" class="btn btn-danger" style="float:right; margin:2%;" onclick="window.location.href='logout.php'"><i class="fas fa-sign-out-alt"></i> &nbsp;Logout</button>      
    </div>
</nav>
<div class="container text-center" style="text-align:center;">
  <h4> Players Online</h4>
  <hr>
    <div style="width:80%; margin-left:10%; text-align:left;">
      <span id="onlinepl"> </span>
      <p> <?php echo $error // display error ?></p>
    </div>

  
  <h4> Requests You Have</h4>
  <hr>
  <div class="text-center" style=" margin-left:10%;width:80%; background:white; color:black;" >
  <span id="req"> </span>
  </div>
</div>
  <script>
  function loadreq(){
	  
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("req").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","requests.php?r=1",true);
        xmlhttp.send();
	  
  }
  function loadonlinepl(){
	  
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("onlinepl").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","loadonlinepl.php?r=1",true);
        xmlhttp.send();
	  
  }
  loadreq();
 setInterval("loadreq();",500);
 loadonlinepl();
 setInterval("loadonlinepl();",500
 );
  </script>
  
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<div class="footer">
    <center>
      <b>
        <h4 style="color: blue;">Follow Us</h4>
        <a href="https://www.instagram.com/_simplethoughts._/?hl=en" target="_blank" title="Instagram"><button type="button" class="btn btn-info"><i class="fa fa-instagram"></i></button></a>
        <a href="https://www.linkedin.com/in/aditya-pandey-1375a818a/" target="_blank"  title="Linkedin"><button type="button" class="btn btn-info"><i class="fa fa-linkedin"></i></button></a>
        <a href="https://adityapandey.me/"  target="_blank" title="Portfolio"><button type="button" class="btn btn-info"><i class="fas fa-link"></i></button></a>
        <a href="https://github.com/adi0603"  target="_blank" title="Github"><button type="button" class="btn btn-info"><i class="fab fa-github"></i></button></a><br><br>
        <div class="row">
          <div class="col-md-12 copy">
            <p class="text-center" style="color: blue;">&copy; TIC TAC TOE - 2021 | Aditya Pandey<br>  All rights reserved.</p>
          </div>
        </div>
      </b>
    </center>
</div>
</body>
</html>